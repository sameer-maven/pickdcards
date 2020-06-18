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
use App\Generalsettings;
use App\Helper;
use Auth;
use Image;
use DB;
use App\Industry;
use App\Type;
use Session;
use Stripe;
use QrCode;
use App\Transaction;


class AdminController extends Controller
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

    public function index()
    {
         $data['total_orders'] = Order::orderBy('id','desc')->count();
         $data['total_sale'] = number_format(Order::where(['status'=>'1'])->orderBy('id','desc')->sum("balance"),2);
        
        $sql = Order::where(['status'=>'1']);
        $date = date('Y-m-d');
        $data['total_today_orders'] = $sql->where('created_at', 'LIKE', '%'.$date.'%')->count();
        $data['total_today_sale'] = number_format($sql->where('created_at', 'LIKE', '%'.$date.'%')->sum("balance"),2);
         $data['total_users'] = User::where('is_admin','=',null)->orderBy('id','desc')->count();
        
        return view('admin.dashboard')->with($data); 
    }

    public function profile()
    {
        //get admin profile
        $data['adminProfile'] = Auth::user();

        return view('admin.profile')->with($data);
    }

    public function storeProfile(Request $request)
    {
        $input         = $request->all();
        $id            = Auth::user()->id;

        //$input['business_name'];
        $validatedData = $request->validate([
            'name'  => 'required',
            'email' => 'required'
        ]);

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
                
                Helper::resizeImageFixed( $temp.$avatar, 180, 180, $temp.$avatar );
                
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

        $user        = User::find($id);
        $user->name  = $input['name'];
        $user->email = $input['email'];
        $user->save();
        
        \Session::flash('notification'," Profile Updated Successfully.");
        return redirect('admin/profile');
    }

    public function changePassword()
    {
        return view('admin.change-password');
    }

    public function storePassword(Request $request)
    {
        $input = $request->all();
        $id    = Auth::user()->id;

        $validatedData = $request->validate([
            'password'  => 'required',
        ]);

        $user = User::find($id);
        $user->password  = \Hash::make($input[ "password"] );
        $user->save();
        
        \Session::flash('notification'," Password Changed Successfully.");
        return redirect('/admin/change-password');
    }

    public function usersList()
    {
        
        $query = Input::get('q');
        
        if( $query != '' && strlen( $query ) > 2 ) {
            $data = User::where('is_admin','=',null)
            ->where('name', 'LIKE', '%'.$query.'%')
            ->orWhere('email', 'LIKE', '%'.$query.'%')
            ->orderBy('id','desc')->paginate(10);
         } else {
            $data = User::where('is_admin','=',null)->orderBy('name','asc')->paginate(25);
         }
        
        return view('admin.users-list', ['data' => $data,'query' => $query]);

    }

    public function editUsers ($id) {

          
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
                'b.phone_number',
                'b.business_email',
                'b.url',
                'b.industry_id',
                'b.type_id',
                'b.tax_id_number',
                'b.customer_charge',
                'b.customer_cent_charge',
                'b.business_charge',
                'b.business_cent_charge'
            )
         ->leftjoin('businessinfos as b', 'b.user_id', '=', 'u.id')
         ->where('u.id', $id)->first();

        $data['Industries']           = Industry::where('status','1')->orderBy('industry')->get();
        $data['Types']                = Type::where('status','1')->orderBy('type')->get();

        return view('admin.edit-users')->with($data);
    }

    public function updateUsers (Request $request) {

        $input = $request->all();
        $id    = $input["id"];

        $validatedData = $request->validate([
            'name'  => 'required',
            'email'  => 'required'
        ]);

        $userBusinessInfo = DB::table('businessinfos')->where('user_id',$id)->first();
        if ($userBusinessInfo !== null) {
            $usersBusInfo                  = Businessinfo::find($userBusinessInfo->id);

            if(!empty($input['business_name'])){
                $usersBusInfo->business_name   = $input['business_name'];
            }

            if(!empty($input['address'])){
                $usersBusInfo->address         = $input['address'];
            }

            if(!empty($input['phone_number'])){
                $usersBusInfo->phone_number    = $input['phone_number'];
            }

            if(!empty($input['business_email'])){
                $usersBusInfo->business_email  = $input['business_email'];
            }

            if(!empty($input['url'])){
                $usersBusInfo->url = $input['url'];
            }

            if(!empty($input['tax_id_number'])){
                $usersBusInfo->tax_id_number   = $input['tax_id_number'];
            }

            if(!empty($input['business_industry'])){
                $usersBusInfo->industry_id     = $input['business_industry'];
            }

            if(!empty($input['business_type'])){
                $usersBusInfo->type_id         = $input['business_type'];
            }
            
            if(!empty($input['customer_charge'])){
                $usersBusInfo->customer_charge = $input['customer_charge'];
            }

            if(!empty($input['customer_cent_charge'])){
                $usersBusInfo->customer_cent_charge = $input['customer_cent_charge'];
            }

            if(!empty($input['business_charge'])){
                $usersBusInfo->business_charge = $input['business_charge'];
            }

            if(!empty($input['business_cent_charge'])){
                $usersBusInfo->business_cent_charge = $input['business_cent_charge'];
            }

            $usersBusInfo->save();
        }

        $user            = User::find($id);
        $user->name      = $input['name'];
        $user->email     = $input['email'];
        $user->status    = $input['status'];
        $user->is_verify = $input['is_verify'];
        $user->save();
        
        \Session::flash('notification',"User Details Updated Successfully.");
        return redirect('/admin/users-list');
    }

    public function deleteUser ($id) {

        
        $users = User::find($id);

        if(!isset($users) || $users->is_admin == 1 ) {
            return redirect('admin/users-list');
        }else{ 
            $userBusinessInfo = DB::table('businessinfos')->where('user_id',$id)->first();
            if ($userBusinessInfo !== null) {
                // Delete business info
                $usersBusInfoDelete = Businessinfo::find($userBusinessInfo->id);
                $usersBusInfoDelete->delete();
                // Delete user info
                $users->delete();
            }else{
                // Delete user info
                $users->delete();
            }
        }
        
        \Session::flash('notification',"User Deleted Successfully.");
        return redirect('/admin/users-list');
    }

    public function ordersList()
    {
        
        $query = Input::get('q');
        
        if( $query != '' && strlen( $query ) > 2 ) {
            $custquery = DB::table('orders as o')->select('o.*','u.name');
            $custquery->where('u.name', 'LIKE', '%'.$query.'%');
            $custquery->orWhere('o.customer_full_name', 'LIKE', '%'.$query.'%');
            $custquery->orWhere('o.customer_email', 'LIKE', '%'.$query.'%');
            $data = $custquery->leftjoin('users as u', 'o.user_id', '=', 'u.id')->orderBy('id','desc')->paginate(25)->appends(["q" => $query]);
         } else {
            $data = DB::table('orders as o')->select('o.*','u.name')
                    ->leftjoin('users as u', 'o.user_id', '=', 'u.id')->orderBy('id','desc')->paginate(25);
         }
        
        return view('admin.orders-list', ['data' => $data,'query' => $query]);

    }

    public function orderDetail($id)
    {
        $data['order'] = Order::find($id);

        $data['user'] = DB::table('users as u')->select(
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
                'b.phone_number',
                'b.business_email',
                'b.url',
                'b.industry_id',
                'b.type_id',
                'b.tax_id_number',
                'b.customer_charge',
                'b.customer_cent_charge',
                'b.business_charge',
                'b.business_cent_charge'
            )
         ->leftjoin('businessinfos as b', 'b.user_id', '=', 'u.id')
         ->where('u.id', $data['order']->user_id)->first();

        return view('admin.orders-view')->with($data);   
    }

    public function orderTransactions($id)
    {
        $data['transactions'] = DB::table('transactions')->where('order_id','=',$id)->get();
        $data['order_id']     = $id;
        return view('admin.orders-transactions')->with($data);   
    }

    public function commissionSettings()
    {
        return redirect('/admin/dashboard');
        $data['settings'] = Generalsettings::find(1);
        return view('admin.commission-settings')->with($data);   
    }

    public function updateCommissionSettings (Request $request) {
        $input = $request->all();
        
        $validatedData = $request->validate([
            'customer_charge'  => 'required',
            'business_charge'  => 'required'
        ]);

        $Generalsettings = Generalsettings::find(1);

        $Generalsettings->customer_charge = $input['customer_charge'];
        $Generalsettings->business_charge = $input['business_charge'];
        $Generalsettings->save();
        \Session::flash('notification',"Settings Updated Successfully.");
        return redirect('/admin/commission-settings');
    }

    public function profileSocials()
    {
        $data['settings'] = Generalsettings::find(1);
        return view('admin.profile-socials')->with($data);
    }

    public function updateSocialSettings (Request $request) {
        $input = $request->all();
        $Generalsettings = Generalsettings::find(1);
        $Generalsettings->facebook = $input['facebook'];
        $Generalsettings->twitter = $input['twitter'];
        $Generalsettings->linkedin = $input['linkedin'];
        $Generalsettings->instagram = $input['instagram'];
        $Generalsettings->youtube = $input['youtube'];
        $Generalsettings->pinterest = $input['pinterest'];
        $Generalsettings->save();
        \Session::flash('notification',"Settings Updated Successfully.");
        return redirect('/admin/profile-socials');
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
            'b.business_name',
            'b.address',
            'b.city',
            'b.state',
            'b.pincode',
            'b.phone_number'
        )->leftjoin('businessinfos as b', 'b.user_id', '=', 'u.id')->where('u.id', $order->user_id)->first();
        
        $business_name = str_replace(' ', '', $user->business_name);
        
        $qrFilename    = 'qrcode_order_'.$order_id.'_user_'.$business_name.'_'.time().str_random(10).'.png';
        $path          = 'public/qrcode/';
        $filename      = $path.$order->qrcode;
        
        if (\File::exists($filename)) {

            //\File::delete($filename);

            $amount = $order->balance-$order->used_amount;
            
            //$randstr   = Helper::generateRandomString(4);
            //$card_code = strtoupper($business_name).'-'.round($amount).'-'.$randstr;
            //QrCode::format('png')->size(300)->generate('GIFT CARD CODE: '.strtoupper($business_name).round($amount), public_path('qrcode/'.$qrFilename));
            //$uorder         = Order::find($order_id);
            //$uorder->qrcode = $qrFilename;
            //$uorder->save();

            $order = Order::find($order_id);
            $data  = [
                        'avatar'          => asset('public/avatar/'.$user->avatar),
                        'balance'         => round($amount),
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
                    
            $data['recipient_name'] = $order->customer_full_name;
            $data['subject']        = "You have purchased a Gift Card for ".$order->recipient_name;
            Mail::to($order->customer_email)->send(new RecipientSendEmail($data));

            $data['recipient_name'] = $order->recipient_name;
            $data['subject']        = "You have received a Gift Card from ".$order->customer_full_name;
            Mail::to($order->recipient_email)->send(new RecipientSendEmail($data));
        }

        \Session::flash('notification',"The card has been re-sent to the customer and the recipient. ");
        return redirect('/admin/order-detail/'.$order_id);
        
    }

}
