<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Userpro;

use Carbon\Carbon; 
use Input;
use Validator;
use Redirect;
use Session;

class ApiController extends Controller
{


     public function add(Request $request)
    {

       $validator = Validator::make($request->all(), [
                'id' => 'required',
                'name' => 'required',
                'email' => 'required',
                'age' => 'required',
                'profileImage' => 'required'
            ]);
       if ($validator->fails()) {
             return response()->json([
                'error' => true,
                'message' => 'Invalid Parameter!',
                'status' => '400'
            ]);
        }
        else{
         
        
        $user = new Userpro;

        $user->id = $request->id;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->age= $request->age;

        if($request->hasFile('profileImage')) {
            
            $file = Input::file('profileImage');
            //getting timestamp
            
            $timestamp = str_replace([' ', ':'], '-', Carbon::now()->toDateTimeString());
            
            $name = $timestamp. '-' .$file->getClientOriginalName();
            
            $user->profileImage = '/images/'.$name;

            $file->move(public_path().'/images/', $name);
        }
        else
         return response()->json([
                'error' => true,
                'message' => 'Image Not Uploaded',
                'status' => '400'
            ]);


        $user->save();

        return response()->json([
                'error' => false,
                'message' => 'User Added',
                'status' => '200'
            ]);
        }
    }


     public function fetch(Request $request) {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'name' => 'required',
        ]);
        $id = $request->id;
        $name = $request->name;

        if ($validator->fails()) {
             return response()->json([
                'error' => true,
                'message' => 'Invalid Parameter!',
                'status' => '400'
            ]);
        }
        else{
            $user = Userpro::find($id)->where('id', '=', $id)->where('name', 'like', '%'.(string)$name.'%')->get();
            //$user = $user->find(find($id, array('id', 'name', 'email', 'age', 'profileImage'))
            //$user = Userpro::find($id, array('id', 'name', 'email', 'age', 'profileImage'));
            //$user[0]['profileImage'] = '/images/'.$user[0]['profileImage'];
            if($user->count())
            { return response()->json(array(
                        'error' => false,
                        'users' => $user,
                        'status_code' => 200
                    ));
            }
            else{
                return response()->json(array(
                        'error' => true,
                        'message' => 'No User Found',
                        'status_code' => 404
                    ));
            }
        }

     }


     public function show(Request $request){
         $validator = Validator::make($request->all(), [
            'id' => 'required',
            ]);
        $id = $request->id;    
        $user = Userpro::find($id, array('id', 'name', 'email', 'age', 'profileImage'));
        return view('user.show', compact('user'));
     }
    

}
