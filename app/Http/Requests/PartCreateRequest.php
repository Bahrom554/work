<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PartCreateRequest extends FormRequest
{
   public function rules(){
    return[
         'name'=>'required|string|max:255',
         'type'=>'nullable|string|max:255',
       ];
   }
}