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
                'title'        =>      'required',
                'company_name' =>      'required',
                'content'      =>      'required',
            ]);
        // Update Rules     
        } else {
            return Validator::make($data, [
                'title'        =>      'required',
                'company_name' =>      'required',
                'content'      =>      'required',
            ]);
        }
        
    }

    public function index() {
        $query = Input::get('q');
        
        if( $query != '' && strlen( $query ) > 2 ) {
            $data = Testimonial::where('title', 'LIKE', '%'.$query.'%')
            ->orWhere('company_name', 'LIKE', '%'.$query.'%')
            ->orderBy('id','desc')->paginate(10);
         } else {
            $data = Testimonial::orderBy('title','asc')->paginate(25);
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
            'company_name' => 'required'
        ]);

        $temp      = 'public/temp/';
        $path      = 'public/testimonials/';
        $photoName = '';
        //<--- HASFILE PHOTO
        if( $request->hasFile('photo') ){
            $validator = Validator::make($request->all(), ['photo' => 'required|mimes:jpg,gif,png,jpe,jpeg|image_size:>=180,>=180|max:2MB']);
            $extension = $request->file('photo')->getClientOriginalExtension();
            $avatar    = strtolower(Auth::user()->id.time().str_random(10).'.'.$extension );
            if($request->file('photo')->move($temp, $avatar) ) {
                if (\File::exists($temp.$avatar) ) { 
                    $img = \Image::make($temp.$avatar)->resize(100, 120);
                    $img->save($path.$avatar, 60);
                    \File::delete($temp.$avatar);
                }    
            }
        }//<--- HASFILE PHOTO 

        $data = array(
            "title"        => $input['title'],
            "company_name" => $input['company_name'],
            "content"      => $input['content'],
            "photo"        => $avatar
        );

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
            'title'        => 'required',
            'company_name' => 'required'
        ]);
            
        $lang->fill($input)->save();

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
