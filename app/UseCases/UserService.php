<?php

namespace App\UseCases;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

class UserService
{
    public function index(Request $request){

        $query = QueryBuilder::for(User::class);
        if (!empty(request()->get('search'))){
            $query->where('name', 'like', '%'.request()->get('search').'%')
                ->orWhere('username', 'like', '%'.request()->get('search').'%');
        }
        $query->allowedIncludes(!empty($request->include) ? explode(',', $request->get('include')) : []);
        $query->allowedSorts(request()->sort);
        return $query->get();
    }

    public function create($request)
    {
        $user = User::make($request->only('name', 'email'));
        if($request->has('password')){
            $user->password = bcrypt($request->password);
        }
        
        $user->save();
        return $user;
    }


    public function edit($id, $request){
        $user = $this->getUser($id);
        $user->update($request->only([
            'name',
            'username',
        ]));
        return $user;

    }
    public function remove($id)
    {
        $user = $this->getUser($id);

        $user->delete();
    }
    public function resetPassword(Request $request , $id){
        $user=$this->getUser($id);
        $user->password = bcrypt($request->password);
        $user->save();
        return $user;
    }

    private function getUser($id):User
    {
        return User::findOrFail($id);
    }


}
