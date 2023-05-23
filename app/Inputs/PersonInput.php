<?php

namespace App\Inputs;

use App\Models\Person;

class PersonInput
{
    public static function set($person_id)
    {
        $query =  Person::query();
        $person = $query->find($person_id);

        if(!$person) {
            return null;
        }

        return [
            'name' => $person->name,
			'razon_name' => $person->razon_name,
			'identity_document_id' => $person->identity_document_id,
			'document' => $person->document,
            'country_id' => $person->country_id,
            'department_id' => $person->department_id,
            'province_id' => $person->province_id,
            'district_id' => $person->district_id,
            'address' => $person->address,
            'email' => $person->email,
            'phone' => $person->phone
        ];
    }
}
