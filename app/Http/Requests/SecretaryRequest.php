<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;
use Illuminate\Validation\Rule;
use App\User;

class SecretaryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
     
    public function authorize()
    {
        return Auth::user()->doctor();
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
            'middle_initial' => 'required|size:1',
            'lastname' => 'required',
            'birthdate' => 'required',
            'sex' => 'required',
            'contact_number' => 'required|min:6',
            'address' => 'required',
            'username' => 'required|unique:users',
            'email' => 'required|unique:users',
            'attainment' => 'required'
        ];

        if($this->isMethod('post')){
            $rules['username'] = 'required|unique:users';
            $rules['email'] = 'required|unique:users';
        }else{
            // dd($this->route('doctor'));
            $rules['username'] = [
                'required',
                 Rule::unique('users')->ignore($this->input('user_id'))
            ];
             $rules['email'] = [
                'required',
                 Rule::unique('users')->ignore($this->input('user_id'))
            ];
        }

        return $rules;
    }

     public function messages()
    {
        return [
            'firstname.required' => 'Please enter first name.',
            'middle_initial.required' => 'Please enter middle initial.',
            'lastname.required' => 'Please enter last name.',
            'birthdate.required' => 'Please enter birthdate.',
            'sex.required' => 'Please enter gender.',
            'contact_number.required' => 'Please enter contact number.',
            'address.required' => 'Please enter home address.',
            'username.required' => 'Please enter username.',
            'email.required' => 'Please enter email.',
            'email.unique' => 'Email already taken',
            'contact_number.min' => 'Please enter valid contact number.',
            'username.unique' => 'Taken username.',
            'attainment.required' => 'Please enter educational attainment'
        ];
    }
}
