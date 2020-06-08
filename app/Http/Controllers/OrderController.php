<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendEmail;
use App\Mail\RecipientSendEmail;
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
            // 'phone_number'    => 'required',
            'card_amount'     => 'required',
            'recipient_email' => 'required',
            'recipient_note'  => 'required'
        ]);

        $order = new Order;
        $order->user_id                  = $id;
        $order->customer_full_name       = $input['name'];
        $order->customer_email           = $input['email'];
        $order->customer_phone           = "";

        if(isset($input['business_email']) && !empty($input['business_email'])){
            $order->customer_bussiness_email = $input['business_email'];
        }else{
            $order->customer_bussiness_email = "";
        }

        $user = DB::table('users as u')->select(
                'u.id',
                'u.name',
                'u.email',
                'u.avatar',
                'u.status',
                'u.is_verify',
                'u.created_at',
                'b.business_name',
                'b.connected_stripe_account_id',
                'b.customer_charge',
                'b.customer_cent_charge',
                'b.business_charge',
                'b.business_cent_charge')
         ->leftjoin('businessinfos as b', 'b.user_id', '=', 'u.id')
         ->where('u.id', $id)->first();

        $customer_fee = Helper::getPercentOfNumber($input['card_amount'],$user->customer_charge);
        $customer_fee = $customer_fee + $user->customer_cent_charge;
        $actualAmount = round($input['card_amount'] + $customer_fee, 2);
        
        // Stripe Fee
        $stripe_fees          = ($actualAmount * 0.029) + 0.30;
        $stripe_fees          = round($stripe_fees,2);

        if($user->business_charge!= 0){
            $business_fee = Helper::getPercentOfNumber($input['card_amount'],$user->business_charge);
            $business_fee = round($business_fee + $user->business_cent_charge, 2);
        }else{
            $business_fee = $user->business_charge;
        }

        $business_user_amount = round($input['card_amount'] - $business_fee,2);
        
        $pickd_card_amount    = $actualAmount - $stripe_fees - $business_user_amount;

        // echo "Customer Fee: ".$customer_fee."</br>";
        // echo "Business Fee: ".$business_fee."</br></br></br>";
        
        // echo "Customer Paid: ".$actualAmount."</br>";
        // echo "stripe_fees: ".$stripe_fees."</br>";
        // echo "business_user_amount: ".$business_user_amount."</br>";
        // echo "pickd: ".$pickd_card_amount."</br>";
        // die;
        
        $paymentOpt = [
          'payment_method_types'   => ['card'],
          'amount'                 => $actualAmount*100,
          'currency'               => 'usd',
        ];

        if($pickd_card_amount > 0){
            $paymentOpt['application_fee_amount'] = $pickd_card_amount*100;   
        }

        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        $payment_intent = Stripe\PaymentIntent::create($paymentOpt, ['stripe_account' => $user->connected_stripe_account_id]);

        $order->amount                       = $actualAmount;
        $order->trx_id                       = $payment_intent->id;
        $order->qrcode                       = "";
        $order->balance                      = $input['card_amount'];
        $order->used_amount                  = 0.00;
        $order->admin_fee_amount             = $pickd_card_amount;
        $order->business_user_amount         = $business_user_amount;
        $order->stripe_fees                  = $stripe_fees;
        $order->payment_intent_client_secret = $payment_intent->client_secret;
        $order->recipient_name               = $input['recipient_name'];
        $order->recipient_email              = $input['recipient_email'];
        $order->recipient_notes              = $input['recipient_note'];
        $order->stripe_response              = $payment_intent;
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


    public function makeIntent($id) {
        $order_id = base64_decode($id);
        $order = Order::find($order_id);

        $user = DB::table('users as u')->select(
                'u.id',
                'u.name',
                'b.business_name',
                'b.connected_stripe_account_id')
         ->leftjoin('businessinfos as b', 'b.user_id', '=', 'u.id')
         ->where('u.id', $order->user_id)->first();
        
        if($order->status=='0'){
            $data['id']             = base64_encode($order->id);  
            $data['balance']        = $order->balance;
            $data['amount']         = $order->amount;
            $data['fee_amount']     = $order->amount - $order->balance;
            $data['payment_intent'] = $order->payment_intent_client_secret;
            $data['stripeAccount']  = $user->connected_stripe_account_id;
            return view('make_payment_new')->with($data);
        }else{
           return redirect('/search'); 
        } 
    }

    public function storePayment(Request $request){
        
        $input    = $request->all();
        $order_id = base64_decode($input['order_id']);

        if($input['paid']==1){
            
            $order = Order::find($order_id);
            
            $user = DB::table('users as u')->select(
                'u.id',
                'u.name',
                'u.email',
                'u.avatar',
                'u.status',
                'u.is_verify',
                'b.business_name',
                'b.address',
                'b.city',
                'b.state',
                'b.pincode',
                'b.phone_number'
            )->leftjoin('businessinfos as b', 'b.user_id', '=', 'u.id')->where('u.id', $order->user_id)->first();

            $business_name = str_replace(' ', '', $user->business_name);

            $filename  = 'qrcode_order_'.$order_id.'_user_'.$business_name.'_'.time().str_random(10).'.png';
            $randstr   = Helper::generateRandomString(4);
            $card_code = strtoupper($business_name).'-'.round($order->balance).'-'.$randstr;

            QrCode::format('png')->size(300)->generate('GIFT CARD CODE: '.$card_code, public_path('qrcode/'.$filename));

            $order            = Order::find($order_id);
            $order->status    = 1;
            $order->qrcode    = $filename;
            $order->card_code = $card_code;
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

            $data  = [
                        'avatar'          => asset('public/avatar/'.$user->avatar),
                        'recipient_name'  => $order->recipient_name,
                        'balance'         => round($order->balance),
                        'qrcode'          => asset('public/qrcode/'.$order->qrcode),
                        'qrcodeText'      => $order->card_code,
                        'senderName'      => $order->customer_full_name,
                        'senderNotes'     => $order->recipient_notes,
                        'businessName'    => $user->business_name,
                        'businessAddress' => $user->address.", ".$user->city.", ".$user->state.", ".$user->pincode,
                        'businessPhone'   => $user->phone_number,
                        'bgImg'           => asset('public/front-email-template/img/bg.jpg'),
                        'mainbgImg'       => asset('public/front-email-template/img/main-bg.jpg'),
                        'footerLogoImg'   => asset('public/front-email-template/img/logo.png')
                    ];
            Mail::to($order->recipient_email)->send(new RecipientSendEmail($data));


            $data['qrimage'] = $filename;
            
            $return['url'] = url('/order/thank-you/'.$input['order_id']);
            echo json_encode($return);   
        }else{
            echo "Something went wrong, Please try again.";
        }
    }

    public function thankYou($id){

        $order_id = base64_decode($id);
        $order    = Order::find($order_id);

        if ($order) { 
            $businessinfo    = Businessinfo::where('user_id', $order->user_id)->first();
            $data['qrimage'] = $order->qrcode;
            $data['orderInfo'] = $order;
            $data['businessinfo'] = $businessinfo;
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
