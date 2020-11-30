<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePeRequest extends FormRequest
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
            "criteria" => "required",
            "living_province" => "required",
            "living_regency" => "required",
            "living_district" => "required",
            "living_village" => "required",
            "living_street" => "required",
            "living_rt" => "nullable",
            "living_rw" => "nullable",
            "symptoms_toggle" => "required",
            "symptoms_at" => "required_if:symptoms_toggle,yes",
            "symptoms" => "required_if:symptoms_toggle,yes",
            "symptoms_else" => "nullable",
            "comorbidities_toggle" => "required",
            "comorbidities" => "required_if:comorbidities_toggle,yes",
            "comorbidities_else" => "nullable",
            "diagnoses_toggle" => "required",
            "diagnoses" => "required_if:diagnoses_toggle,yes",
            "diagnoses_else" => "nullable",
            "hospital_toggle" => "required",
            "hospital_start_at" => "required_if:hospital_toggle,yes",
            "hospital_name" => "required_if:hospital_toggle,yes",
            "hospital_additions" => "nullable",
            "hospital_name_history" => "nullable",
            "hospital_status" => "required_if:hospital_toggle,yes",
            "travel_history_international_toggle" => "required",
            "travel_history_international_country" => "required_if:travel_history_international_toggle,yes",
            "travel_history_international_regency" => "required_if:travel_history_international_toggle,yes",
            "travel_history_international_departure_at" => "required_if:travel_history_international_toggle,yes",
            "travel_history_international_arrive_at" => "required_if:travel_history_international_toggle,yes",
            "travel_history_domestic_toggle" => "required",
            "travel_history_domestic_regency" => "required_if:travel_history_domestic_toggle,yes",
            "travel_history_domestic_departure_at" => "required_if:travel_history_domestic_toggle,yes",
            "travel_history_domestic_arrive_at" => "required_if:travel_history_domestic_toggle,yes",
            "travel_history_living_toggle" => "required",
            "travel_history_living_regency" => "required_if:travel_history_living_toggle,yes",
            "travel_history_living_departure_at" => "required_if:travel_history_living_toggle,yes",
            "travel_history_living_arrive_at" => "required_if:travel_history_living_toggle,yes",
            "contact_history_normal_toggle" => "required",
            "contact_history_normal_name" => "required_if:contact_history_normal_toggle,yes",
            "contact_history_normal_address" => "required_if:contact_history_normal_toggle,yes",
            "contact_history_normal_phone" => "required_if:contact_history_normal_toggle,yes",
            "contact_history_normal_gender" => "required_if:contact_history_normal_toggle,yes",
            "contact_history_normal_status" => "required_if:contact_history_normal_toggle,yes",
            "contact_history_normal_start_at" => "required_if:contact_history_normal_toggle,yes",
            "contact_history_normal_end_at" => "required_if:contact_history_normal_toggle,yes",
            "contact_history_close_toggle" => "required",
            "contact_history_close_name" => "required_if:contact_history_close_toggle,yes",
            "contact_history_close_address" => "required_if:contact_history_close_toggle,yes",
            "contact_history_close_phone" => "required_if:contact_history_close_toggle,yes",
            "contact_history_close_gender" => "required_if:contact_history_close_toggle,yes",
            "contact_history_close_status" => "required_if:contact_history_close_toggle,yes",
            "contact_history_close_start_at" => "required_if:contact_history_close_toggle,yes",
            "contact_history_close_end_at" => "required_if:contact_history_close_toggle,yes",
            "ispa" => "required",
            "pet_toggle" => "required",
            "pet" => "required_if:pet_toggle,yes",
            "health_worker_toggle" => "required",
            "protectors" => "required_if:health_worker_toggle,yes",
            "tube_code" => "nullable",
            "group_code" => "nullable",
        ];
    }
}
