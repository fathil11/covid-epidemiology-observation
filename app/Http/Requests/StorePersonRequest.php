<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePersonRequest extends FormRequest
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
        return [
            "nik" => "required",
            "name" => "required",
            "phone" => "required",
            "gender" => "required",
            "id_card_file" => "required|mimes:jpeg,bmp,png,jpg",
            "birth_regency" => "required",
            "birth_at" => "required",
            "parent_name" => "nullable",
            "work" => "required",
            "work_instance" => "nullable",
            "card_province" => "required",
            "card_regency" => "required",
            "card_district" => "required",
            "card_village" => "required",
            "card_street" => "required",
            "card_rt" => "nullable",
            "card_rw" => "nullable",
        ];
    }
}
