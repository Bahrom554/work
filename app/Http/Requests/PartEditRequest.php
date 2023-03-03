<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PartEditRequest extends FormRequest
{
   public function rules(){
    return[
         'name'=>'string|max:255',
         'type'=>'nullable|string|max:255',
       ];
   }
}