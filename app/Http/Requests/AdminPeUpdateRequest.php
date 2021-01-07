<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminPeUpdateRequest extends FormRequest
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
            //! Person Section
            "nik" => "nullable|min:16|max:16",
            "name" => "required",
            "phone" => "nullable",
            "gender" => "required",
            "birth_regency" => "nullable",
            "birth_at" => "nullable",
            "parent_name" => "nullable",
            "work" => "nullable",
            "work_instance" => "nullable",
            "card_province" => "nullable",
            "card_regency" => "nullable",
            "card_district" => "nullable",
            "card_village" => "nullable",
            "card_street" => "nullable",
            "card_rt" => "nullable",
            "card_rw" => "nullable",

            //! PE Section
            "living_province" => "nullable",
            "living_regency" => "nullable",
            "living_district" => "nullable",
            "living_village" => "nullable",
            "living_street" => "nullable",
            "living_rt" => "nullable",
            "living_rw" => "nullable",
            "swab_priority" => "nullable",
            "swab_type" => "required",
            "swab_location" => "required",
            "note" => "nullable",

        ];
    }
}
