<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input as Input;
use App\Helper;

class TestimonialsController extends Controller
{
    
    protected function validator(array $data, $id = null) {
        
        Validator::extend('ascii_only', function($attribute, $value, $parameters){
            return !preg_match('/[^x00-x7F\-]/i', $value);
        });
                
        // Create Rules
        if( $id == null ) {
            return Validator::make($data, [
                'title'        =>      'required'
            ]);
        // Update Rules     
        } else {
            return Validator::make($data, [
                'title'        =>      'required'
            ]);
        }
        
    }

    public function index() {
        $query = Input::get('q');
        
        if( $query != '' && strlen( $query ) > 2 ) {
            $data = Testimonial::where('title', 'LIKE', '%'.$query.'%')
            ->orWhere('company_name', 'LIKE', '%'.$query.'%')
            ->orderBy('id','desc')->paginate(15);
         } else {
            $data = Testimonial::orderBy('title','asc')->paginate(15);
         }
        
        return view('admin.testimonials', ['data' => $data,'query' => $query]);
    }

    public function create() {
        return view('admin.add-testimonial');
    }


    public function store(Request $request)
    {
        $input = $request->all();
        $validatedData = $request->validate([
            'title'        => 'required',
        ]);
  
        $temp          = 'public/temp/';
        $path          = 'public/testimonials/';
        
        

        $data          = array(
            "title"        => $input['title'],
            "content"      => $input['content']
        );

        if($input['company_name']!=''){
            $data['company_name'] = $input['company_name'];
        }else{
            $data['company_name'] = " "; 
        }

        //<--- HASFILE PHOTO
        if( $request->hasFile('photo') ){
            $validator = Validator::make($request->all(), ['photo' => 'required|mimes:jpg,png,jpe,jpeg|max:10000']);
            $extension = $request->file('photo')->getClientOriginalExtension();
            $avatar    = strtolower(Auth::user()->id.time().str_random(10).'.'.$extension );
            if($request->file('photo')->move($temp, $avatar) ) {
                if (\File::exists($temp.$avatar) ) { 
                    $img = \Image::make($temp.$avatar)->resize(140, 140);
                    $img->save($path.$avatar);
                    \File::delete($temp.$avatar);
                }    
            }
            $data['photo'] = $avatar;
        }//<--- HASFILE PHOTO

        Testimonial::create($data);
        \Session::flash('notification',"Testimonial Added Successfully.");
        return redirect('/admin/testimonials');
    }

    public function edit($id)
    {
        $data = Testimonial::findOrFail($id);

        return view('admin.edit-testimonial')->withData($data);
    }

    public function update($id, Request $request)
    {
        $lang = Testimonial::findOrFail($id);
        
        $input = $request->all();
            
        $validatedData = $request->validate([
            'title'        => 'required'
        ]);

        $temp   = 'public/temp/';
        $path   = 'public/testimonials/';
        $imgOld = $path.$lang->photo;

        $data = array(
            "title"        => $input['title'],
            "company_name" => $input['company_name'],
            "content"      => $input['content']
        );

        if($input['company_name']!=''){
            $data['company_name'] = $input['company_name'];
        }else{
            $data['company_name'] = " "; 
        }

        //<--- HASFILE PHOTO
        if( $request->hasFile('photo') ){
            $validator = Validator::make($request->all(), ['photo' => 'required|mimes:jpg,gif,png,jpe,jpeg|image_size:>=180,>=180|max:2MB']);
            $extension = $request->file('photo')->getClientOriginalExtension();
            $avatar    = strtolower(Auth::user()->id.time().str_random(10).'.'.$extension );
            if($request->file('photo')->move($temp, $avatar) ) {

                if (\File::exists($temp.$avatar) ) { 
                    $img = \Image::make($temp.$avatar)->resize(140, 140);
                    $img->save($path.$avatar);
                    \File::delete($temp.$avatar);
                }
                
                //<<<-- Delete old image -->>>/
                if ( \File::exists($imgOld) && $imgOld != $path.'default.jpg' ) {  
                    \File::delete($imgOld);
                }//<--- IF FILE EXISTS #1
            }
            $data['photo'] = $avatar;
        }//<--- HASFILE PHOTO
        
        

        $lang->fill($data)->save();

        \Session::flash('notification',"Testimonial Edited Successfully.");

        return redirect('admin/testimonials');
    }

    public function destroyPage($id)
    {
        $lang = Testimonial::findOrFail($id);
        $lang->delete();
        \Session::flash('notification',"Testimonial Deleted Successfully.");
        return redirect('admin/testimonials');
    }
}
