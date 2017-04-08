<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PostRequest extends FormRequest
{
    public function authorize() {
        return true;
    }

    public function rules() {
        return [
            'category' => 'required',
            'title' => 'required|max:255',
            'message' => 'required',
        ];
    }
}
