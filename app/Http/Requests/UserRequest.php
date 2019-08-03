<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class UserRequest extends FormRequest
{
    /**
     * request indicator
     * this flag indicates request's type
     * false equals adding
     * true equals updating
     *
     * @var bool
     */
    private $__isUpdatingRequest = false;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $result = array_diff($this->__updateMethod(), $this->route()->methods); // check the request whether updating or inserting one
        if (empty($result)) {                                                   // check the result of comparison
            $this->__isUpdatingRequest = !$this->__isUpdatingRequest;           // update the flag which indicates the type of request
            return Auth::check();                                               // check user's auth.
        }
        return true;

    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        $rules['name'] = 'required|string';                                   // name's validation rules
        $id = '';                                                             // initialize the id variable
        if ($this->__isUpdatingRequest) {                                     // check the type of request if it is an updating request
            $id = ',' . request()->user;                                      // add the exceptional id

        } else {
            $rules['password'] = 'required|min:6';                            // add password validation
        }
        $rules['email'] = "required|email|unique:users,email$id";             // add email validation
        return $rules;
    }

    /**
     * HTTP updating methods
     *
     * @return array
     */
    private function __updateMethod()
    {
        return ['PUT', 'PATCH'];                                              // HTTP methods
    }
}
