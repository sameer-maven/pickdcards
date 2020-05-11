<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input as Input;
use App\User;
use App\Businessinfo;
use App\Helper;
use Auth;
use Image;
use DB;
use App\Industry;
use App\Type;

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
        return view('admin.dashboard');
    }

    public function profile()
    {
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

        $temp    = 'temp/';
        $path    = 'avatar/'; 
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
            $data = User::where('is_admin','=',null)->orderBy('id','desc')->paginate(10);
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
                'b.bank_name',
                'b.bank_routing_number',
                'b.bank_account_number'

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
            $usersBusInfo                      = Businessinfo::find($userBusinessInfo->id);
            $usersBusInfo->business_name       = $input['business_name'];
            $usersBusInfo->address             = $input['address'];
            $usersBusInfo->phone_number        = $input['phone_number'];
            $usersBusInfo->business_email      = $input['business_email'];
            $usersBusInfo->url                 = $input['url'];
            
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

}
