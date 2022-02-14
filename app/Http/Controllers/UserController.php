<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserModel;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = UserModel::all();
        return view('users.show',compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = new UserModel;
        $response = [];


        $user->firstName = $request->input('firstName');
        $user->lastName = $request->input('lastName');
        $user->email = $request->input('email');
        $user->password = md5($request->input('password'));
        $user->age = $request->input('age');
        
        $date = $request->input('dob');
        $user->dob = date('Y-m-d', strtotime(str_replace('-', '/', $date)));
        
        $user->phoneNumber = $request->input('phoneNumber');
        $user->bio = $request->input('Bio');

        if($user->save()){
            $response = ['status'=>'ok','message'=>'Your Data Successfully Ineserted'];
        } else {
            $response = ['status'=>'error','message'=>'Your Data Inesertion Faild'];
        }
        
        return $response;  
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //$user = NewCustomerModel::all();
        //return view('users.show',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         $editUser = UserModel::find($id);

         $response= [];

         $editUser['dob'] =  date('m/d/Y', strtotime(str_replace('/', '-', $editUser['dob']))); 

         $response = ['status'=>'ok','data'=>$editUser];
         return $response;
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
       $user = UserModel::find($id);
       $response = [];

       $user->firstName = $request->input('firstName');
       $user->lastName = $request->input('lastName');
       $user->age = $request->input('age');
       $date = $request->input('dob');
       $user->dob = date('Y-m-d', strtotime(str_replace('-', '/', $date)));
        
       $user->phoneNumber = $request->input('phoneNumber');
       $user->bio = $request->input('Bio');

        if($user->save()){
            $user['dob'] = date('d-M-Y', strtotime($date));
            $response = ['status'=>'ok','message'=>'Your Data Successfully Ineserted','data'=>$user];
        } else {
            $response = ['status'=>'error','message'=>'Your Data Inesertion Faild'];
        }
        
        return $response;  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = UserModel::find($id);
        $response = [];
        
        if($user->delete()){
            $response = ['status'=>'ok','message'=>'Your Data Successfully Deleted.'];
         } else {
            $response = ['status'=>'error','message'=>'Your Data Deletion is faild.'];
         }
         return $response;
        //return redirect()->back()->with('success','Data Successfully Deleted');
    }
}
