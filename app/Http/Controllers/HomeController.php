<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input as Input;
use App\User;
use App\Businessinfo;
use App\Newsletter;
use App\Helper;
use Auth;
use Image;
use DB;
use App\Industry;
use App\Type;
use App\State;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    { 
        $socials      = DB::table('generalsettings')->where('id',1)->first();
        $testimonials = DB::table('testimonials')->get();
        return view('home',['socials' => $socials,'testimonials' => $testimonials]);   
    }

    public function getSearch()
    {
        
        $query      = Input::get('name');
        $cityInp    = Input::get('city');
        $stateInp   = Input::get('state');
        $zipcodeInp = Input::get('zipcode');
        $industyInp = Input::get('industry');
        $Industries = Industry::where('status','1')->orderBy('industry')->get();
        $Types      = Type::where('status','1')->orderBy('type')->get();
        $States     = State::where('status','1')->orderBy('state_name')->get();
        $socials    = DB::table('generalsettings')->where('id',1)->first();
        if($query != '' && strlen($query) > 2) {
           
            $data = DB::table('businessinfos')->select("*")
            ->where('business_name','LIKE', '%'.$query.'%')
            ->where('status','=',1)
            ->where('is_verify','=',1)
            ->where('connected_stripe_account_id','!=',NULL)
            ->orderBy('business_name','asc')
            ->paginate(16)->appends("name",$query);

         }elseif ($cityInp != '' || $stateInp != '' || $zipcodeInp != '' || $industyInp !='') {

         	$cusQuery = DB::table('businessinfos')->select('*')
            ->where('status','=',1)
            ->where('is_verify','=',1)
            ->where('connected_stripe_account_id','!=',NULL);

			if ($cityInp != ""){
			    $cusQuery->where('city', 'LIKE', '%'.$cityInp.'%');
			}

			if ($stateInp != ""){
			    $cusQuery->where('state', 'LIKE', '%'.$stateInp.'%');
			}

            if ($zipcodeInp != ""){
                $cusQuery->where('pincode','=',$zipcodeInp);
            }

            if ($industyInp != ""){
                $cusQuery->where('industry_id','=',$industyInp);
            }
			$data = $cusQuery->orderBy('business_name','asc')->paginate(16)->appends(['city'=>$cityInp,'state'=>$stateInp,'zipcode'=>$zipcodeInp,'industry'=>$industyInp]);
            
         }else {

            $data = DB::table('businessinfos')->select("*")
            ->where('status','=',1)
            ->where('is_verify','=',1)
            ->where('connected_stripe_account_id','!=',NULL)
            ->orderBy('business_name','asc')
            ->paginate(16);
         }
        return view('search', ['data' => $data,'query' => $query,'Industries'=>$Industries,'Types'=>$Types,'States'=>$States,'socials' => $socials]);
    }

    public function newsLetterSave(Request $request)
    {
        $input             = $request->all();
        $newsLetter        = New Newsletter;
        $newsLetter->email = $input['email'];
        $save              = $newsLetter->save();
        if($save){
            \Session::flash('newsSuccess',"Newsletter Subscribed Successfully");
            return redirect('/');
        }
    }
}
