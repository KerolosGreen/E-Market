<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\File; 

use Illuminate\Http\Request;
use App\Models\user;
use App\Models\info;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class userscontroller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $users=user::paginate(5);
        return view('admin-users',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        if(filesize($request->file('image'))==false){
            $filename = 'user.jpg';
        }
        else{
        $filename = time().'.'.$request->file('image')->getClientOriginalExtension();
        $request->file('image')->move(public_path('images'), $filename);
        }

         user::create(
             [
                 'firstname'=>$request->firstname,
                 'lastname'=>$request->lastname,
                 'email'=>$request->email,
                 'role'=>$request->role,
                 'password'=>$request->password,
                 'image'=>$filename,
                 'active'=>'1',
                 'phone_number'=>$request->phonenumber,
             ]
         );
         return redirect()->route('users.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    public function updateimage(Request $request)
    {
        //
        $user=user::find(Auth::user()->id);
        if(filesize($request->file('image'))==false){
            $filename = Auth::user()->image;
        }
        else{
            if(Auth::user()->image!='user.jpg')
            {
               File::delete(public_path('images/'.Auth::user()->image));  
            }
        $filename = time().'.'.$request->file('image')->getClientOriginalExtension();
        $request->file('image')->move(public_path('images'), $filename);
        }
        $user->update(
            [
                'image'=>$filename,
            ]
        );
        return redirect()->back();
    }

    public function updateprofile(Request $request)
    {
        //
        $user = user::find(Auth::user()->id);
        $user->update(
            [
                'firstname'=>$request->firstname,
                'lastname'=>$request->lastname,
                'email'=>$request->email,
                'phone_number'=>$request->phonenumber,
            ]
        );
        if($request->address!=null){
        $info = info::where('user_id',Auth::user()->id)->first();
        if($info==null){
            info::create([
                'user_id'=>Auth::user()->id,//AUTH
                'address'=>$request->address,
                'country'=>$request->country,
                'city'=>$request->city
            ]);
        }  
        else{
            $info->update([
                'address'=>$request->address,
                'country'=>$request->country,
                'city'=>$request->city
            ]);
        } 
        }
        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $user = user::find($id);
        //Check Image
        if(filesize($request->file('image'))==false){
            $filename = $user->image;
        }
        else{
            if(Auth::user()->image!=='user.jpg')
            {
            File::delete(public_path('images/'.$user->image)); 
            }
        $filename = time().'.'.$request->file('image')->getClientOriginalExtension();
        $request->file('image')->move(public_path('images'), $filename);
        }
        //Check Password
        if($request->password==''){
            $password = $user->password;

            $user->update(
                [
                    'firstname'=>$request->firstname,
                    'lastname'=>$request->lastname,
                    'email'=>$request->email,
                    'role'=>$request->role,
                    'password'=>$password,
                    'image'=>$filename,
                    'active'=>$request->status,
                    'phone_number'=>$request->phonenumber,
                ]
            );
        }
        else{
            $password = $request->password;
            $user->update(
                [
                    'firstname'=>$request->firstname,
                    'lastname'=>$request->lastname,
                    'email'=>$request->email,
                    'role'=>$request->role,
                    'password'=>Hash::make($password),
                    'image'=>$filename,
                    'active'=>$request->status,
                    'phone_number'=>$request->phonenumber,
                ]
            );
        }

        // $user->update(
        //      [
        //          'firstname'=>$request->firstname,
        //          'lastname'=>$request->lastname,
        //          'email'=>$request->email,
        //          'role'=>$request->role,
        //          'password'=>Hash::make($password),
        //          'image'=>$filename,
        //          'active'=>$request->status,
        //          'phone_number'=>$request->phonenumber,
        //      ]
        //  );
         return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $user=user::find($id);
        if(Auth::user()->image!=='user.jpg')
            {
        File::delete(public_path('images/'.$user->image));
            }
        $user->delete();
        return redirect()->route('users.index');

    }

    public function retrieveprofile()
    {
        //
        if(Auth::check()){
            $user=user::find(Auth::user()->id);
            return view('user-edit',compact('user'));
        }
        else{
            return redirect()->route('/login');
        }
    }
}
