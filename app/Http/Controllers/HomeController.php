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
        
		$query       = Input::get('name');
		$industryInp = Input::get('industry');
		$typeInp     = Input::get('type');
		$zipcodeInp  = Input::get('zipcode');

        $Industries = Industry::where('status','1')->orderBy('industry')->get();
		$Types = Type::where('status','1')->orderBy('type')->get();

        if($query != '' && strlen($query) > 2) {
           
            $data = DB::table('users as u')->select(
                'u.id',
                'u.name',
                'b.business_name',
                'b.address'
            )->leftjoin('businessinfos as b', 'b.user_id', '=', 'u.id')
            ->where('u.is_admin','=',null)
            ->where('b.business_name','LIKE', '%'.$query.'%')
            ->where('u.status','=',1)
            ->orderBy('id','desc')
            ->paginate(16)->appends("name",$query);

         }elseif ($industryInp != '' || $typeInp != '' || $zipcodeInp != '') {

         	$cusQuery = DB::table('users as u')->select(
                'u.id',
                'u.name',
                'b.business_name',
                'b.address'
            )->leftjoin('businessinfos as b', 'b.user_id', '=', 'u.id')
            ->where('u.is_admin','=',null)
            ->where('u.status','=',1);

			if ($industryInp != ""){
			    $cusQuery->where('b.industry_id', '=', $industryInp);
			}

			if ($typeInp != ""){
			    $cusQuery->where('b.type_id', '=', $typeInp);
			}

            if ($zipcodeInp != ""){
                $cusQuery->where('b.address','LIKE', '%'.$zipcodeInp.'%');
            }

			$data = $cusQuery->orderBy('id','desc')->paginate(16)->appends(['industry'=>$industryInp,'type'=>$typeInp,'zipcode'=>$zipcodeInp]);
         } 
         else {
            $data = DB::table('users as u')->select(
                'u.id',
                'u.name',
                'b.business_name',
                'b.address'
            )->leftjoin('businessinfos as b', 'b.user_id', '=', 'u.id')
            ->where('u.is_admin','=',null)
            ->where('u.status','=',1)
            ->orderBy('id','desc')
            ->paginate(16);
         }
        
        return view('search', ['data' => $data,'query' => $query,'Industries'=>$Industries,'Types'=>$Types]);

    }
}
