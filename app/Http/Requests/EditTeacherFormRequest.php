<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditTeacherFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
			$id = $this->route('id');

			switch($this->method())
			{
				 case 'GET':
				 case 'DELETE':
				 {
						 return [];
				 }
				 case 'POST':
				 {
						 return [
							'name' => 'required|max:255',
							'username' => 'required|max:255|unique:users,username',
							'email' => 'required|email|max:255|unique:users',
							'password' => 'required|min:6|confirmed',
							'gender' => 'required|same:m,f',
							'dob' => 'required',
							'gender' => 'required',
							'phone' => 'required|regex:/[0-9]{9}/',
						 ];
				 }
				 case 'PUT':
				 case 'PATCH':
				 {
						 return [
							'name' => 'required|max:255',
							'username' => 'required|max:255|unique:users,id,'.$id,
							'email' => 'required|email|max:255|unique:users,id,'.$id,
							'gender' => 'required|same:m,f',
							'dob' => 'required',
							'gender' => 'required',
							'phone' => 'required|regex:/[0-9]{9}/',
						 ];
				 }
				 default:break;
			}
    }
}
