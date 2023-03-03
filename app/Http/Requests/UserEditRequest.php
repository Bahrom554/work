<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class UserEditRequest extends FormRequest
{

    public function rules()
    {
        return [
            'name'=>'string|max:255',
            'email'=>'string|email|unique:users,email,'.($this->user->id ?? Auth::id()),
            'group_id'=>'nullable|integer|exists:groups,id',
            'password'=>'nullable|string|confirmed|min:6',
        ];
    }
}
