<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Group;
use Illuminate\Http\Request;
use App\UseCases\UserService;
use Illuminate\Auth\Access\Gate;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UserEditRequest;
use App\Http\Requests\UserCreateRequest;

class ProfileController extends Controller
{
   
   

    public function edit(){
       
        $user=Auth::user();
        return view('users.profile',compact('user'));
        }
    public function update(UserEditRequest $request)
    {      
         if($request->filled('password')){
            $request['password'] = bcrypt($request->password);
          }
          else{
            unset($request['password']);
          }
         User::findOrFail(Auth::id())->update($request->only([
            'name',
            'username',
            'phone',
            'password'
        ]));
        return redirect()->back()->with('message','Updated Successfully');

    }

    

   


}
