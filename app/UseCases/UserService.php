<?php

namespace App\UseCases;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        DB::beginTransaction();
        try {
        $user = User::make($request->only('name', 'email','team_id','phone'));
        if($request->has('password')){
            $user->password = bcrypt($request->password);
        }
         $user->save();
         if ($request->filled('role')) {
            $user->syncRoles($request->role);
            if ($user->hasRole(User::ROLE_ADMIN)) {
                $user->removeRole(User::ROLE_ADMIN);
            }
        }
        DB::commit();
    } catch (\Exception $e) {
        DB::rollBack();
        return redirect()->back()->withErrors( $e->getMessage());
    }
        return $user;
    }


    public function edit($id, $request){
        $user = $this->getUser($id);
        $user->update($request->only([
            'name',
            'username',
            'team_id',
            'phone'
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
