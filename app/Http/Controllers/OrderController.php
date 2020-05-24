<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendEmail;
use Illuminate\Support\Facades\Input as Input;
use App\Order;
use App\User;
use App\Businessinfo;
use App\Helper;
use Auth;
use Image;
use DB;
use App\Industry;
use App\Type;
use Session;
use Stripe;
use QrCode;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //  
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input        = $request->all();
        $id           = base64_decode($input['user_id']);
        //$input['business_name'];
        $validatedData = $request->validate([
            'name'            => 'required',
            'email'           => 'required',
            'phone_number'    => 'required',
            'card_amount'     => 'required',
            'recipient_email' => 'required',
            'recipient_note'  => 'required'
        ]);

        $order = new Order;
        $order->user_id                  = $id;
        $order->customer_full_name       = $input['name'];
        $order->customer_email           = $input['email'];
        $order->customer_phone           = $input['phone_number'];

        if(isset($input['business_email']) && !empty($input['business_email'])){
            $order->customer_bussiness_email = $input['business_email'];
        }else{
            $order->customer_bussiness_email = "";
        }

        $adminCommision = Helper::getPercentOfNumber($input['card_amount'],3);

        $actualAmount = $input['card_amount'] + $adminCommision;

        $order->amount                   = $actualAmount;
        $order->trx_id                   = "";
        $order->qrcode                   = "";
        $order->balance                  = $input['card_amount'];
        $order->used_amount              = 0;
        $order->recipient_name           = $input['recipient_name'];
        $order->recipient_email          = $input['recipient_email'];
        $order->recipient_notes          = $input['recipient_note'];
        $order->stripe_response          = "";
        $order->save();
        
        return redirect('/order/make-payment/'.base64_encode($order->id));
    }

    public function makePayment ($id) {
        $order_id = base64_decode($id);
        $order = Order::find($order_id);
        
        if($order->status=='0'){
            $data['id'] = base64_encode($order->id);  
            $data['amount'] = $order->amount;
            return view('make_payment')->with($data);
        }else{
           return redirect('/search'); 
        }
         
    }

    public function storePayment(Request $request){
        
        $input    = $request->all();
        
        $order_id = base64_decode($input['order_id']);
        $amount   = $input['amount'];

        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        $response = Stripe\Charge::create ([
            "amount"      => $amount * 100,
            "currency"    => "usd",
            "source"      => $input['stripeToken'],
            "description" => "Order ".$order_id
        ]);

        if($response->paid==1){
            
            $order = Order::find($order_id);
            
            $user = DB::table('users as u')->select(
                'u.id',
                'u.name',
                'u.email',
                'u.avatar',
                'u.status',
                'u.is_verify',
                'b.business_name'
            )->leftjoin('businessinfos as b', 'b.user_id', '=', 'u.id')->where('u.id', $order->user_id)->first();

            $business_name = str_replace(' ', '', $user->business_name);

            $filename = 'qrcode_order_'.$order_id.'_user_'.$business_name.'_'.time().str_random(10).'.png';
            
            QrCode::format('png')->size(300)->generate('GIFT CARD CODE: '.strtoupper($business_name).round($order->balance), public_path('qrcode/'.$filename));

            $order = Order::find($order_id);
            $order->status = 1;
            $order->qrcode = $filename;
            $order->trx_id = $response->id;
            $order->stripe_response = $response;
            $order->save();

            $order = Order::find($order_id);
            $data  = [
                        'avatar'        => asset('public/avatar/'.$user->avatar),
                        'customer_name' => $order->customer_full_name,
                        'balance'       => round($order->balance),
                        'qrcode'        => asset('public/qrcode/'.$order->qrcode),
                        'bgImg'         => asset('public/front-email-template/img/bg.jpg'),
                        'mainbgImg'     => asset('public/front-email-template/img/main-bg.jpg'),
                        'footerLogoImg' => asset('public/front-email-template/img/logo.png')
                    ];

            Mail::to($order->customer_email)->send(new SendEmail($data));

            $data['qrimage'] = $filename;
            return redirect('/order/thank-you/'.$input['order_id']);
        }else{
            echo "Something went wrong, Please try again.";
        }
    }

    public function thankYou($id){

        $order_id = base64_decode($id);
        $order    = Order::find($order_id);

        if ($order) { 
            $data['qrimage'] = $order->qrcode;
            return view('thank_you')->with($data);
        }else{
            return redirect('/search');
        }
    }

    public function fillOrderDetails ($id) {
        
        $id = base64_decode($id);

        $data['users'] = DB::table('users as u')->select(
                'u.id',
                'u.name',
                'u.email',
                'u.avatar',
                'u.status',
                'u.is_verify',
                'u.created_at',
                'b.business_name',
                'b.address',
                'b.city',
                'b.state',
                'b.about_business',
                'b.phone_number',
                'b.business_email',
                'b.url',
                'b.industry_id',
                'b.type_id',
                'b.tax_id_number'
            )
         ->leftjoin('businessinfos as b', 'b.user_id', '=', 'u.id')
         ->where('u.id', $id)->first();

        return view('fill_order_detail')->with($data);
    }

    public function storeDetail($id) {
        
        $id = base64_decode($id);

        $data['users'] = DB::table('users as u')->select(
                'u.id',
                'u.name',
                'u.email',
                'u.avatar',
                'u.status',
                'u.is_verify',
                'u.created_at',
                'b.business_name',
                'b.address',
                'b.city',
                'b.state',
                'b.about_business',
                'b.phone_number',
                'b.business_email',
                'b.url',
                'b.industry_id',
                'b.type_id',
                'b.tax_id_number'
            )
         ->leftjoin('businessinfos as b', 'b.user_id', '=', 'u.id')
         ->where('u.id', $id)->first();

        return view('store_detail')->with($data);
    }

}
