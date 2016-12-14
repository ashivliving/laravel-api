<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Userpro;

use Carbon\Carbon; 
use Input;
use Validator;
use Redirect;
use Session;

class UserProfile extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return "By - Ashiv Gupta";
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,array(
                'id' => 'required',
                'name' => 'required',
                'email' => 'required',
                'age' => 'required',
                'profileImage' => 'required'
            ));
        $user = new Userpro;

        $user->id = $request->id;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->age= $request->age;

        if($request->file('profileImage')->isValid()) {
            
            $file = Input::file('profileImage');
            //getting timestamp
            
            $timestamp = str_replace([' ', ':'], '-', Carbon::now()->toDateTimeString());
            
            $name = $timestamp. '-' .$file->getClientOriginalName();
            
            $user->profileImage = $name;

            $file->move(public_path().'/images/', $name);
        }
        else
         return response()->json([
                'message' => 'Image Not Uploaded',
                'status' => '400'
            ]);


        $user->save();

        return response()->json([
                'message' => 'User Added',
                'status' => '200'
            ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        return "Hey show";
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
