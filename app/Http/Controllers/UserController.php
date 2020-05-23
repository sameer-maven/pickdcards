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
use Auth;
use DB;

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
        $sql->bank_name           = "";
        $sql->bank_routing_number = "";
        $sql->bank_account_number = "";
        $saved                    = $sql->save();

        if($saved){
            $user  = User::find($id);
            $user->is_business_profile_complete = '1';
            $user->save();
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
                'b.phone_number',
                'b.business_email',
                'b.url',
                'b.industry_id',
                'b.type_id',
                'b.tax_id_number',
                'b.bank_name',
                'b.bank_routing_number',
                'b.bank_account_number'
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

        $usersBusInfo->business_name  = $input['business_name'];
        $usersBusInfo->address        = $input['address'];
        $usersBusInfo->city           = $input['city'];
        $usersBusInfo->state          = $input['state'];
        $usersBusInfo->pincode        = $input['pincode'];
        $usersBusInfo->phone_number   = $input['phone_number'];
        $usersBusInfo->business_email = $input['business_email'];
        
        if(isset($input['url']) && !empty($input['url'])){
            $usersBusInfo->url             = $input['url'];
        }
        
        if(isset($input['bank_name']) && !empty($input['bank_name'])){
            $usersBusInfo->bank_name           = $input['bank_name'];
        }
        if(isset($input['bank_account_number']) && !empty($input['bank_account_number'])){
            $usersBusInfo->bank_account_number           = $input['bank_account_number'];
        }

        if(isset($input['bank_routing_number']) && !empty($input['bank_routing_number'])){
            $usersBusInfo->bank_routing_number           = $input['bank_routing_number'];
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
            }

            if($datefilter!= ''){
                $explode = explode('/', $datefilter);
                $from =  $explode[0];
                $to =  $explode[1];
                $ordQuery->whereBetween('created_at',[$from, $to]);
            }

            $data = $ordQuery->orderBy('id','desc')->paginate(15)->appends(["name"=>$query,"datefilter"=>$datefilter]);

        } else {
            $data = Order::where(['user_id'=>$id,'status'=>'1'])->orderBy('id','desc')->paginate(15);
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

        $is_business_profile_complete = Auth::user()->is_business_profile_complete;
        if($is_business_profile_complete == '0'){
            return redirect('/user');  
        }else{  
            if(!empty($data)){
                return view('user_order_detail',['data' => $data]);
            }else{
                return redirect('/user/orders');
            }
        }
    }

}
