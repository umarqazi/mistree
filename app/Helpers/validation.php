<?php

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

if (! function_exists('validate_inputs')) {
    function validate_inputs($request,$inputs)
    {
        $rules = [
            'name'                           => 'sometimes|required|string',
            'owner_name'                     => 'sometimes|required|regex:/^[\pL\s\-]+$/u',
            'email'                          => 'sometimes|required|email|unique:workshops',
            'password'                       => 'sometimes|required|confirmed|min:6|max:16',
            'password_confirmation'          => 'sometimes|required',
            'cnic'                           => 'sometimes|required|regex:/^\d{5}-\d{7}-\d{1}$/u',
            'mobile'                         => 'sometimes|required|regex:/^0?3\d{2}-\d{7}$/u',
            'landline'                       => 'sometimes|regex:/^\d{10,11}$/u|nullable',
            'open_time'                      => 'sometimes|required',
            'close_time'                     => 'sometimes|required',
            'type'                           => 'sometimes|required|in:Authorized,Unauthorized',
            'team_slots'                     => 'sometimes|integer',
            'profile_pic'                    => 'sometimes|image|mimes:jpg,png,jpeg',
            'cnic_image'                     => 'sometimes|image|mimes:jpg,png,jpeg',
            'images.*'                       => 'sometimes|image|mimes:jpg,png,jpeg',

            'shop'                           => 'sometimes|nullable|regex:/^[a-zA-Z\s\/\-\d]+$/u',
            'building'                       => 'sometimes|string|nullable',
            'block'                          => 'sometimes|string|nullable',
            'street'                         => 'sometimes|nullable|string',
            'town'                           => 'sometimes|required|regex:/^[\pL\s\-]+$/u',
            'city'                           => 'sometimes|required|regex:/^[\pL\s\-]+$/u',

            'hatchback.*'                    => 'sometimes|required|integer:unique',
            'hatchback-rates.*'              => 'sometimes|required',
            'hatchback-times.*'              => 'required',

            'sedan.*'                        => 'sometimes|required|integer:unique',
            'sedan-rates.*'                  => 'sometimes|required',
            'sedan-times.*'                  => 'sometimes|required',

            'luxury.*'                       => 'sometimes|required|integer:unique',
            'luxury-rates.*'                 => 'sometimes|required',
            'luxury-times.*'                 => 'sometimes|required',

            'suv.*'                          => 'sometimes|required|integer:unique',
            'suv-rates.*'                    => 'sometimes|required',
            'suv-times.*'                    => 'sometimes|required'
        ];

        $validator = Validator::make($inputs, $rules);
        return $validator;
    }
}