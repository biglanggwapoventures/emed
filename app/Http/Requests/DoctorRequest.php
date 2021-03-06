<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;
use Illuminate\Validation\Rule;
use App\User;
use App\Doctor;
//use Illuminate\Contracts\Validation\Validator;

use Log;

class DoctorRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // return Auth::user()->isAdmin() ||  Auth::user()->isDoctor();
        return true;
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
            'birthdate' => 'required|date_format:"Y-m-d"|before:tomorrow',
            'sex' => 'required:in:Male,Female',
            'contact_number' => 'required|min:6',
            'address' => 'required',
            'username' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            // 'specialization' => 'required',
            'title' => 'required',
            // 'clinic' => 'required',
            // 'clinic_address' => 'required',
            // 'clinic_hours' => 'required',
            'med_school' => 'required',
            'med_school_year' => 'required|date_format:"Y"',
            'residency' => 'required',
            'residency_year' => 'required|date_format:"Y"',
            'training' => 'required',
            'training_year' => 'required|date_format:"Y"',
            // 'subspecialty' => 'required',
            // 'affiliations' => 'required',
            // 'specialization' => 'required|exists:specializations,id',
            // 'subspecializations' => 'array|required',
            // 'subspecializations.*' => 'required|exists:subspecializations,id',
            'affiliations' => 'array|required',
            'affiliations.*.affiliation_id' => 'required|exists:affiliations,id',
            'affiliations.*.branch_id' => 'required|exists:affiliation_branches,id',
            'affiliations.*.clinic_start' => 'required',
            'affiliations.*.clinic_end' => 'required|different:affiliations.*.clinic_start',
            'organizations' => 'array|required',
            'organizations.*' => 'required|exists:organizations,id',

            'spec.*.name' => 'distinct',
        ];

        // Log::info('METHOD: ' . $this->method());
        // Log::info($this);
        // if($this->method == 'POST')
        // {
        if(is_null($this->user_id) || empty($this->user_id))
        {
            $rules['prc'] = 'required|unique:doctors'; 
            $rules['ptr'] = 'required|unique:doctors';
            $rules['s2'] = 'required|unique:doctors';
        }
        else
        {
            if(Doctor::getPRCNo($this->user_id) != $this->prc)
            {
                $rules['prc'] = 'required|unique:doctors'; 
            }

            if(Doctor::getPTRNo($this->user_id) != $this->ptr)
            {
                $rules['ptr'] = 'required|unique:doctors';
            }

            if(Doctor::getS2No($this->user_id) != $this->s2)
            {
                $rules['s2'] = 'required|unique:doctors';
            }
        }
            

        // dd($this->route("doctor"));
        if($this->route("doctor"))
        {
            $user_id = \App\Doctor::find($this->route("doctor"))->user_id;
            $rules['username'] = 'required|unique:users,username,'.$user_id;
            $rules['email'] = 'required|unique:users,username,'.$user_id;
            if(Auth::user()->isDoctor()){
                unset($rules['prc'], $rules['ptr'], $rules['s2']);
            }
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
             'birthdate.before_or_equal' => 'Please enter valid birthdate.',
            'sex.required' => 'Please enter your gender.',
            'contact_number.required' => 'Please enter your contact number.',
            'address.required' => 'Please enter your home address.',
            'address.unique' => 'Address already exists',
            'username.required' => 'Please enter your username.',
            'email.required' => 'Please enter your email.',
            'prc.required' => 'Please enter your  PRC license number.',
            'ptr.required' => 'Please enter your PTR number.',
            'specialization.required' => 'Please enter your specialization.',
            'title.required' => 'Please enter your title.',
            'clinic.required' => 'Please enter your clinic name.',
            'clinic_address.required' => 'Please enter your clinic address.',
            'clinic_start.required' => 'Please enter your clinic_start hours.',
            'clinic_end.required' => 'Please enter your clinic_end hours.',
            'clinic_end.different' => 'You cannot close. You just opened!.',
            'med_school.required' => 'Please enter your med school.',
            'med_school_year.required' => 'Please enter your med school year.',
            'residency.required' => 'Please enter your residency.',
            'residency_year.required' => 'Please enter your residency year.',
            'training.required' => 'Please enter your training.',
            'training_year.required' => 'Please enter your training year.',
             'affiliations.required' => 'Please enter your affiliations.',
            'contact_number.min' => 'Please enter valid contact number.',
            's2.required' => 'Please enter S2 number.',
             'spec.*.name' => 'distinct',
        ];
    }

  
}
