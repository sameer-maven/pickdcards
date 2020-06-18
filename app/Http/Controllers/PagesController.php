<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Pages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input as Input;

class PagesController extends Controller
{
    
    protected function validator(array $data, $id = null) {
        
        Validator::extend('ascii_only', function($attribute, $value, $parameters){
            return !preg_match('/[^x00-x7F\-]/i', $value);
        });
                
        // Create Rules
        if( $id == null ) {
            return Validator::make($data, [
            'title'      =>      'required',
            'slug'       =>      'required|ascii_only|alpha_dash|unique:pages',
            'content'    =>      'required',
        ]);
        
        // Update Rules     
        } else {
            return Validator::make($data, [
                'title'      =>      'required',
                'slug'       =>      'required|ascii_only|alpha_dash|unique:pages,slug,'.$id,
                'content'    =>      'required',
            ]);
        }
        
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index() {
        $query = Input::get('q');
        
        if( $query != '' && strlen( $query ) > 2 ) {
            $data = Pages::where('title', 'LIKE', '%'.$query.'%')
            ->orWhere('slug', 'LIKE', '%'.$query.'%')
            ->orderBy('id','desc')->paginate(10);
         } else {
            $data = Pages::orderBy('title','asc')->paginate(25);
         }
        
        return view('admin.pages', ['data' => $data,'query' => $query]);
     }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('admin.add-page');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        
        $validatedData = $request->validate([
            'title'  => 'required',
            'slug'  => 'required'
        ]);
        
        Pages::create($input);
        
        \Session::flash('notification',"Page Added Successfully.");
        
        return redirect('/admin/pages');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Pages  $pages
     * @return \Illuminate\Http\Response
     */
    public function show($page)
    {
        $response = Pages::where( 'slug','=', $page )->firstOrFail();

        return view('show')->withResponse($response);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Pages  $pages
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Pages::findOrFail($id);

        return view('admin.edit-page')->withData($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pages  $pages
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        $lang = Pages::findOrFail($id);
        
        $input = $request->all();
            
        $validatedData = $request->validate([
            'title'  => 'required',
            'slug'  => 'required'
        ]);
            
        $lang->fill($input)->save();

        \Session::flash('notification',"Page Edited Successfully.");

        return redirect('admin/pages');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pages  $pages
     * @return \Illuminate\Http\Response
     */
    public function destroyPage($id)
    {
        $lang = Pages::findOrFail($id);
        $lang->delete();
        \Session::flash('notification',"Page Deleted Successfully.");
        return redirect('admin/pages');
    }
}
