<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserCreateRequest extends FormRequest
{

    public function rules()
    {
        return [
            'name'=>'required|string|max:255',
            'email'=>'required|email|unique:users',
            'password'=>'required|string|confirmed|min:6',
            'group_id'=>'nullable|integer|exists:groups,id',
            'phone'=>'nullable|string'
        ];
    }
}
