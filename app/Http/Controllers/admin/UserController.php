<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Mail\UserCreatedNotification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $users = User::orderBy('updated_at','desc')->paginate(5);
        return view('admin.user.user_list', ['users'=>$users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.user.user_form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validatedData = $request->validate([
            'name'=>'required|max:255',
            'email'=>'email|required',
            'birth_date'=>'string|required',
            'photo'=>'mimes:jpg,png,svg|max:10240'
        ]);
        
        $user =  $validatedData;
        $pass = Str::random(8);
        $user['pass']=$pass;
        $user['password'] = Hash::make($pass);
        if ($request['admin']) {
            $user['role']= 'admin';
        }

        if($request->file('photo')){
            $file = $request->file('photo');
            $fileName = 'user-'.time().'.'.$file->getClientOriginalExtension();
            $path = $file->storeAs('images/users',$fileName, 'public');
            $user['photo']=$path;
        }

        $newUser = User::create($user);
        if ($newUser) {
            Mail::to($newUser->email)->send(new UserCreatedNotification($user));
           return  redirect()->route('users.list')->with(["status"=>"$newUser->name Added successfully"]);
        }else{
            return back()->with("error","Failed to create the Article")->withInput();
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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

    public function activate(){

    }

    public function search(){
        
    }
}