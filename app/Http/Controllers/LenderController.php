<?php

namespace App\Http\Controllers;

use App\Models\Lender;
use Illuminate\Http\Request;

class LenderController extends Controller
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
        return view('lenders.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'interest' => 'required',
            'company_name' =>'required|string|max:255',
            'category' =>'required|string|max:255',
            'description' =>'required',
            'phone'=>'required|string|max:255',
            'verified'=>''
        ]);
         // Create lender
         $lender = new Lender;
         $lender->interest = $request->input('interest');
         $lender->company_name = $request->input('company_name');
         $lender->category = $request->input('category');
         $lender->description = $request->input('description');
         $lender->phone = $request->input('phone');
         $lender->verified = false;
         $lender->user_id = auth()->user()->id;
         
         
         
         $lender->save();
 
         return redirect('/home')->with('success', 'lender Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Lender  $lender
     * @return \Illuminate\Http\Response
     */
    public function show(Lender $lender)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Lender  $lender
     * @return \Illuminate\Http\Response
     */
    public function edit(Lender $lender)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Lender  $lender
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Lender $lender)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Lender  $lender
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lender $lender)
    {
        //
    }
}
