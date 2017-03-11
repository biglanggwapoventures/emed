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
        if(Auth::user()->user_type === 'ADMIN')
        {
            return Auth::user()->isAdmin();
        }
        else if(Auth::user()->user_type === 'DOCTOR')
        {
            return Auth::user()->isDoctor();
        }
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
            'contact_number' => 'required',
            'address' => 'required',
            'username' => 'required|unique:users',
            'email' => 'required:unique:users',
            'prc' => 'required',
            'ptr' => 'required',
            'specialization' => 'required',
            'title' => 'required',
            'clinic' => 'required',
            'clinic_address' => 'required',
            'clinic_hours' => 'required',
            'med_school' => 'required',
            'med_school_year' => 'required',
            'residency' => 'required',
            'residency_year' => 'required',
            'training' => 'required',
            'training_year' => 'required',
            'subspecialty' => 'required',
            'affiliations' => 'required'
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
            'middle_initial.required' => 'Please enter your middle initial.',
            'lastname.required' => 'Please enter your last name.',
            'birthdate.required' => 'Please enter your birthdate.',
            'sex.required' => 'Please enter your gender.',
            'contact_number.required' => 'Please enter your contact number.',
            'address.required' => 'Please enter your home address.',
            'username.required' => 'Please enter your username.',
            'email.required' => 'Please enter your email.',
            'prc.required' => 'Please enter your PRC license number.',
            'ptr.required' => 'Please enter your PTR number.',
            'specialization.required' => 'Please enter your specialization.',
            'title.required' => 'Please enter your title.',
            'clinic.required' => 'Please enter your clinic name.',
            'clinic_address.required' => 'Please enter your clinic address.',
            'clinic_hours.required' => 'Please enter your clinic hours.',
            'med_school.required' => 'Please enter your med school.',
            'med_school_year.required' => 'Please enter your med school year.',
            'residency.required' => 'Please enter your residency.',
            'residency_year.required' => 'Please enter your residency year.',
            'training.required' => 'Please enter your training.',
            'training_year.required' => 'Please enter your training year.',
            'affiliations.required' => 'Please enter your affiliations.'

        ];
    }
}
