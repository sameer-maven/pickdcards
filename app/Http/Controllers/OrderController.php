<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input as Input;
use App\Order;
use App\User;
use App\Businessinfo;
use App\Helper;
use Auth;
use Image;
use DB;
use App\Industry;
use App\Type;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input        = $request->all();
        $id           = base64_decode($input['user_id']);
        //$input['business_name'];
        $validatedData = $request->validate([
            'name'  => 'required',
            'email' => 'required',
            'phone_number' => 'required',
            'card_amount' => 'required',
            'recipient_email' => 'required',
            'recipient_note' => 'required',
        ]);

        $order = new Order;
        $order->user_id                  = $id;
        $order->customer_full_name       = $input['name'];
        $order->customer_email           = $input['email'];
        $order->customer_phone           = $input['phone_number'];

        if(isset($input['business_email']) && !empty($input['business_email'])){
            $order->customer_bussiness_email = $input['business_email'];
        }else{
            $order->customer_bussiness_email = "";
        }

        $order->amount                   = $input['card_amount'];
        $order->trx_id                   = "";
        $order->recipient_name           = $input['recipient_name'];
        $order->recipient_email          = $input['recipient_email'];
        $order->recipient_notes          = $input['recipient_note'];
        $order->stripe_response          = "";
        $order->save();
        
        \Session::flash('notification',"Order Added Successfully.");
        return redirect('/fill-order-details/'.$input['user_id']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }

    public function fillOrderDetails ($id) {
        $id = base64_decode($id);

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

        return view('fill_order_detail')->with($data);
    }
}
