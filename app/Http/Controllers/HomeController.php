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
        return view('home');   
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

        if($query != '' && strlen($query) > 2) {
           
            $data = DB::table('users as u')->select(
                'u.id',
                'u.name',
                'b.business_name',
                'b.address',
                'b.city',
                'b.state'
            )->leftjoin('businessinfos as b', 'b.user_id', '=', 'u.id')
            ->where('u.is_admin','=',null)
            ->where('b.business_name','LIKE', '%'.$query.'%')
            ->where('u.is_business_profile_complete','=',1)
            ->where('u.status','=',1)
            ->orderBy('id','desc')
            ->paginate(16)->appends("name",$query);

         }elseif ($cityInp != '' || $stateInp != '' || $zipcodeInp != '' || $industyInp !='') {

         	$cusQuery = DB::table('users as u')->select(
                'u.id',
                'u.name',
                'b.business_name',
                'b.address',
                'b.city',
                'b.state'
            )->leftjoin('businessinfos as b', 'b.user_id', '=', 'u.id')
            ->where('u.is_admin','=',null)
            ->where('u.is_business_profile_complete','=',1)
            ->where('u.status','=',1);

			if ($cityInp != ""){
			    $cusQuery->where('b.city', 'LIKE', '%'.$cityInp.'%');
			}

			if ($stateInp != ""){
			    $cusQuery->where('b.state', 'LIKE', '%'.$stateInp.'%');
			}

            if ($zipcodeInp != ""){
                $cusQuery->where('b.pincode','=',$zipcodeInp);
            }

            if ($industyInp != ""){
                $cusQuery->where('b.industry_id','=',$industyInp);
            }
			$data = $cusQuery->orderBy('id','desc')->paginate(16)->appends(['city'=>$cityInp,'state'=>$stateInp,'zipcode'=>$zipcodeInp,'industry'=>$zipcodeInp]);
         }else {
            $data = DB::table('users as u')->select(
                'u.id',
                'u.name',
                'b.business_name',
                'b.address',
                'b.city',
                'b.state'
            )->leftjoin('businessinfos as b', 'b.user_id', '=', 'u.id')
            ->where('u.is_admin','=',null)
            ->where('u.is_business_profile_complete','=',1)
            ->where('u.status','=',1)
            ->orderBy('id','desc')
            ->paginate(16);
         }
        
        return view('search', ['data' => $data,'query' => $query,'Industries'=>$Industries,'Types'=>$Types,'States'=>$States]);

    }
}
