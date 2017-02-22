<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;
use Illuminate\Validation\Rule;
use App\User;

class DoctorRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::user()->isAdmin();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'firstname' => 'required',
            'lastname' => 'required',
            'license' => 'required',
            'middle_initial' => 'required|size:1',
            'sex' => 'required',
            'email' => 'required:unique:users',
            'username' => 'required|unique:users',
            'specialization' => 'required'
        ];

        if($this->isMethod('post')){
            $rules['username'] = 'required:unique:users';
        }else{
            // dd($this->route('doctor'));
            $rules['username'] = [
                'required',
                 Rule::unique('users')->ignore($this->input('user_id'))
            ];
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'firstname.required' => 'Please enter your first name.',
            'lastname.required' => 'Please enter your last name.',
            'middle_initial.required' => 'Please enter your middle initial.',
            'license.required' => 'Please enter your sex.',
            'sex.required' => 'Please enter your gender.',
            'username.required' => 'Please enter your username.',
            'email.required' => 'Please enter your email.',
            'specialization.required' => 'Please enter your specialization.'
        ];
    }
}
