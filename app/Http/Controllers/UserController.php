<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input as Input;
use App\Helper;
use Image;
use App\Industry;
use App\Type;
use App\State;
use App\User;
use App\Order;
use App\Businessinfo;
use App\Transaction;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendEmailAdmin;
use App\Mail\SendEmailUser;
use App\Mail\SendEmail;
use Auth;
use DB;
use Session;
use Stripe;
use QrCode;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {   

        $is_business_profile_complete = Auth::user()->is_business_profile_complete;
        
        $data['Industries'] = Industry::where('status','1')->orderBy('industry')->get();
        $data['Types']      = Type::where('status','1')->orderBy('type')->get();
        $data['States']     = State::where('status','1')->orderBy('state_name')->get();

        if($is_business_profile_complete == '0'){
            return view('user_business_profile')->with($data);  
        }else{
            return view('user_dashboard');   
        }
    }

    public function storeBussDetails(Request $request) {
        
        $input         = $request->all();
        $id            = Auth::user()->id;

        $validatedData = $request->validate([
            'business_name'     => 'required',
            'address'           => 'required',
            'city'              => 'required',
            'state'             => 'required',
            'pincode'           => 'required',
            'phone_number'      => 'required',
            'email'             => 'required',
            'business_industry' => 'required',
            'business_type'     => 'required',
            'tax_id_number'     => 'required'
        ]);

        $sql                 = New Businessinfo;
        $sql->business_name  = trim($input['business_name']);
        $sql->user_id        = $id;
        $sql->address        = $input['address'];
        $sql->city           = $input['city'];
        $sql->state          = $input['state'];
        $sql->pincode        = $input['pincode'];
        $sql->phone_number   = $input['phone_number'];
        $sql->business_email = $input['email'];

        if(isset($input['business_url']) && !empty($input['business_url'])){
            $sql->url             = $input['business_url'];
        }else{
            $sql->url             = ""; 
        }

        $sql->industry_id         = $input['business_industry'];
        $sql->type_id             = $input['business_type'];
        $sql->tax_id_number       = $input['tax_id_number'];
        $sql->about_business      = $input['about_business'];
        $sql->bank_name           = "";
        $sql->bank_routing_number = "";
        $sql->bank_account_number = "";
        $saved                    = $sql->save();

        if($saved){
            $user  = User::find($id);
            $user->is_business_profile_complete = '1';
            $user->save();

            Mail::to($user->email)->send(new SendEmailUser($user));
            $user->business_name = trim($input['business_name']);
            Mail::to("hello@pickdcards.com")->send(new SendEmailAdmin($user));
        }

        \Session::flash('notification',"Business Information Added Successfully");
        return redirect('user');
    }

    public function changePassword()
    {   
        
        $is_business_profile_complete = Auth::user()->is_business_profile_complete;

        if($is_business_profile_complete == '0'){
            return redirect('/user');  
        }else{
            return view('user_change_password');  
        }
    }

    public function storeChangePassword(Request $request)
    {   
        $input         = $request->all();
        $id            = Auth::user()->id;

        $validatedData = $request->validate([
            'old_password' => 'required',
            'password'     => 'required'
        ]);

        if (!Hash::check(trim($input['old_password']), Auth::user()->password)) {
            \Session::flash('incorrect_pass',"Current Password is incorrect.");
            return redirect('user/change-password');
        }

        $user = User::find($id);
        $user->password  = Hash::make($input[ "password"] );
        $user->save();
       
        \Session::flash('notification',"Password Changed Successfully");
       
        return redirect('user/change-password');

    }

    public function manageProfile()
    {   
        
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
                'b.pincode',
                'b.about_business',
                'b.phone_number',
                'b.business_email',
                'b.url',
                'b.industry_id',
                'b.type_id',
                'b.tax_id_number',
                'b.bank_name',
                'b.bank_routing_number',
                'b.bank_account_number',
                'b.connected_stripe_account_id'
            )
         ->leftjoin('businessinfos as b', 'b.user_id', '=', 'u.id')
         ->where('u.id', Auth::user()->id)->first();

        $data['Industries'] = Industry::where('status','1')->orderBy('industry')->get();
        $data['Types']      = Type::where('status','1')->orderBy('type')->get();
        $data['States']     = State::where('status','1')->orderBy('state_name')->get();

        $is_business_profile_complete = Auth::user()->is_business_profile_complete;

        if($is_business_profile_complete == '0'){
            return redirect('/user');  
        }else{
            return view('user_profile')->with($data);  
        }

    }

    public function storeManageProfile(Request $request)
    {
        $input = $request->all();
        $id    = Auth::user()->id;

        $temp    = 'public/temp/';
        $path    = 'public/avatar/'; 
        $imgOld  = $path.Auth::user()->avatar;

        //<--- HASFILE PHOTO
        if( $request->hasFile('photo') )    {

            $validator = Validator::make($request->all(), ['photo' => 'required|mimes:jpg,gif,png,jpe,jpeg|image_size:>=180,>=180|max:2MB']);
            $extension = $request->file('photo')->getClientOriginalExtension();
            $avatar    = strtolower(Auth::user()->id.time().str_random(10).'.'.$extension );
            
            if( $request->file('photo')->move($temp, $avatar) ) {
                
                set_time_limit(0);
                
                //Helper::resizeImageFixed( $temp.$avatar, 200, 100, $temp.$avatar );
                
                // Copy folder
                if ( \File::exists($temp.$avatar) ) {
                    /* Avatar */    
                    \File::copy($temp.$avatar, $path.$avatar);
                    \File::delete($temp.$avatar);
                }//<--- IF FILE EXISTS
                
                //<<<-- Delete old image -->>>/
                if ( \File::exists($imgOld) && $imgOld != $path.'default.jpg' ) {
                    \File::delete($temp.$avatar);   
                    \File::delete($imgOld);
                }//<--- IF FILE EXISTS #1
                
                // Update Database
                User::where( 'id', $id )->update( array( 'avatar' => $avatar ) );   
            }// Move
        }//<--- HASFILE PHOTO 

        $userBusinessInfo = DB::table('businessinfos')->where('user_id',$id)->first();

        if ($userBusinessInfo !== null) {
            $usersBusInfo = Businessinfo::find($userBusinessInfo->id);   
        }else{
            $usersBusInfo = new Businessinfo; 
        }

        $usersBusInfo->business_name  = ucwords($input['business_name']);
        $usersBusInfo->address        = $input['address'];
        $usersBusInfo->city           = $input['city'];
        $usersBusInfo->state          = $input['state'];
        $usersBusInfo->pincode        = $input['pincode'];
        $usersBusInfo->about_business = $input['about_business'];
        $usersBusInfo->phone_number   = $input['phone_number'];
        $usersBusInfo->business_email = $input['business_email'];
        
        if(isset($input['url']) && !empty($input['url'])){
            $usersBusInfo->url = $input['url'];
        }
        
        if(isset($input['bank_name']) && !empty($input['bank_name'])){
            $usersBusInfo->bank_name = $input['bank_name'];
        }
        if(isset($input['bank_account_number']) && !empty($input['bank_account_number'])){
            $usersBusInfo->bank_account_number = $input['bank_account_number'];
        }

        if(isset($input['bank_routing_number']) && !empty($input['bank_routing_number'])){
            $usersBusInfo->bank_routing_number = $input['bank_routing_number'];
        }

        $usersBusInfo->tax_id_number       = $input['tax_id_number'];
        $usersBusInfo->industry_id         = $input['business_industry'];
        $usersBusInfo->type_id             = $input['business_type'];
        $usersBusInfo->save();

        \Session::flash('notification',"Details Updated Successfully.");
        return redirect('/user/manage-profile');
    }

    public function ordersList()
    {
        
        $query = Input::get('q');
        $datefilter = Input::get('datefilter');
        $id    = Auth::user()->id;

        if($query != '' && strlen( $query ) > 2 || $datefilter!= '' && !empty($datefilter )) {

            $ordQuery = Order::where(['user_id'=>$id,'status'=>'1']);            

            if($query != ''){
                $ordQuery->where('customer_full_name', 'LIKE', '%'.$query.'%');
                $ordQuery->orWhere('recipient_name', 'LIKE', '%'.$query.'%');
            }

            if($datefilter!= ''){
                $explode = explode('/', $datefilter);
                $from =  $explode[0];
                $to =  $explode[1];
                $ordQuery->whereBetween('created_at',[$from, $to]);
            }

            $data = $ordQuery->orderBy('id','desc')->paginate(25)->appends(["name"=>$query,"datefilter"=>$datefilter]);

        } else {
            $data = Order::where(['user_id'=>$id,'status'=>'1'])->orderBy('id','desc')->paginate(25);
        }

        $is_business_profile_complete = Auth::user()->is_business_profile_complete;
        if($is_business_profile_complete == '0'){
            return redirect('/user');  
        }else{  
            return view('user_orders', ['data' => $data,'query' => $query]);
        }
        
    }


    public function orderDetail($id)
    {
        $data = Order::find($id);

        $user = DB::table('users as u')->select('u.id','u.name','b.business_name')->leftjoin('businessinfos as b', 'b.user_id', '=', 'u.id')->where('u.id', Auth::user()->id)->first();

        $transactions = DB::table('transactions')->where('order_id','=',$id)->where('user_id','=',Auth::user()->id)->get();

        $is_business_profile_complete = Auth::user()->is_business_profile_complete;
        if($is_business_profile_complete == '0'){
            return redirect('/user');  
        }else{  
            if(!empty($data)){
                return view('user_order_detail',['data' => $data,'user' => $user,'transactions'=>$transactions]);
            }else{
                return redirect('/user/orders');
            }
        }
    }

    public function stripeAuthorization(Request $request)
    {
        $input   = $request->all();
        $user_id = Auth::user()->id;

        if (!isset($input['code']) || isset($input['error'])) {

            if($input['error'] == "access_denied"){
                \Session::flash('error',$input['error_description']);
                return redirect('/user/manage-profile');
            }

        }else{
            
            Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

            $response = \Stripe\OAuth::token([
              'grant_type' => 'authorization_code',
              'code'       => $input['code']
            ]);

            $connected_stripe_account_id = $response->stripe_user_id;

            $userBusinessInfo = DB::table('businessinfos')->where('user_id',$user_id)->first();
            if ($userBusinessInfo !== null) {
                $usersBusInfo = Businessinfo::find($userBusinessInfo->id);   
            }
            // Store connected_stripe_account_id in database.
            $usersBusInfo->connected_stripe_account_id = $response->stripe_user_id;
            $usersBusInfo->save();

            $user  = User::find($user_id);
            $user->is_verify = '1';
            $user->save();

            \Session::flash('notification',"Stripe account connected successfully.");
            return redirect('/user/manage-profile');
        }

    }

    public function stripeDeauthorization(Request $request)
    {
        $user_id          = Auth::user()->id;
        $userBusinessInfo = DB::table('businessinfos')->where('user_id',$user_id)->first();

        if ($userBusinessInfo !== null) {
            $usersBusInfo = Businessinfo::find($userBusinessInfo->id);   
        }
        
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        $response = \Stripe\OAuth::deauthorize([
          'client_id'      => env('STRIPE_CLIENT_ID'),
          'stripe_user_id' => $usersBusInfo->connected_stripe_account_id
        ]);

        $usersBusInfo->connected_stripe_account_id = NULL;
        $usersBusInfo->save();

        $user  = User::find($user_id);
        $user->is_verify = '0';
        $user->save();

        \Session::flash('notification',"Stripe account disconnected successfully.");
        return redirect('/user/manage-profile');
    }

    public function generateQrcode($order_id)
    {
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
        
        $qrFilename    = 'qrcode_order_'.$order_id.'_user_'.$business_name.'_'.time().str_random(10).'.png';
        $path          = 'public/qrcode/';
        $filename      = $path.$order->qrcode;
        
        if (\File::exists($filename)) {

            \File::delete($filename);

            $amount    = $order->balance-$order->used_amount;
            
            $randstr   = Helper::generateRandomString(4);
            $card_code = strtoupper($business_name).'-'.round($amount).'-'.$randstr;

            QrCode::format('png')->size(300)->generate('GIFT CARD CODE: '.$card_code, public_path('qrcode/'.$qrFilename));
            
            $uorder            = Order::find($order_id);
            $uorder->qrcode    = $qrFilename;
            $uorder->card_code = $card_code;
            $uorder->save();

            $order = Order::find($order_id);
            $data  = [
                        'avatar'        => asset('public/avatar/'.$user->avatar),
                        'balance'       => round($amount),
                        'qrcode'        => asset('public/qrcode/'.$order->qrcode),
                        'bgImg'         => asset('public/front-email-template/img/bg.jpg'),
                        'mainbgImg'     => asset('public/front-email-template/img/main-bg.jpg'),
                        'footerLogoImg' => asset('public/front-email-template/img/logo.png')
                    ];
            $data['customer_name'] = $order->customer_full_name;
            Mail::to($order->customer_email)->send(new SendEmail($data));
            
            $data['customer_name'] = $order->recipient_name;
            Mail::to($order->recipient_email)->send(new SendEmail($data));
        }

        \Session::flash('notification',"Qr Code updated, An email sent to customer & recipient successfully.");
        return redirect('/user/order-detail/'.$order_id);
        
    }

    public function redeemAmount($order_id,$amount)
    {
        
        $uorder      = Order::find($order_id);
        $appendsMsg  = "";
        $finalAmount = $uorder->balance - $uorder->used_amount;

        if($amount >= $finalAmount){
            $appendsMsg = "remaining amount";
        }
        
        

        if($amount <= $uorder->balance && $uorder->used_amount == 0){
            $uorder->used_amount = $amount;
            $ret                 = $uorder->save();
            if($ret){                
                $transaction               = new Transaction;
                $transaction->order_id     = $order_id;
                $transaction->user_id      = Auth::user()->id;
                $transaction->tranx_amount = $amount;
                $transaction->save();
                $response = [
                    'save'=>'yes',
                    'message'=>'Amount Redeemed Successfully.',
                ];
                return json_encode($response);
            } 
        }elseif($amount <= $finalAmount){

            $transaction               = new Transaction;
            $transaction->order_id     = $order_id;
            $transaction->user_id      = Auth::user()->id;
            $transaction->tranx_amount = $amount;
            $transaction->save();

            $amount              = $uorder->used_amount+$amount;
            $uorder->used_amount = $amount;
            $ret                 = $uorder->save();

            if($ret){
                $response = [
                    'save'=>'yes',
                    'message'=>'Amount Redeemed Successfully.',
                ];
                return json_encode($response);
            }
        }
        else{
            $response = [
                'save'=>'no',
                'message'=>'Amount should be less or equal to '.$appendsMsg,
            ];
            return json_encode($response);
        }

                  
    }

}
