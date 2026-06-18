<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = [
        'country_id',
        'state_id',
        'addressable_id',
        'addressable_type',
        'address_line_1',
        'address_line_2',
        'city',
        'postal_code',
        'gmaps_full_address',
        'gmaps_place_id',
        'gmaps_latitude',
        'gmaps_longitude',
    ];

    protected $appends = ['full_address'];

    const VALIDATION_RULES = [
        'address' => 'required',
        'address.country_id' => 'required|exists:countries,id',
        'address.state_id' => 'required|exists:states,id',
        'address.address_line_1' => 'required|string',
        'address.address_line_2' => 'nullable|string',
        'address.city' => 'required|string',
        'address.postal_code' => 'required|string',
        'address.gmaps_full_address' => 'nullable|string',
        'address.gmaps_place_id' => 'nullable|string',
        'address.gmaps_longitude' => 'nullable|string',
        'address.gmaps_latitude' => 'nullable|string',
    ];

    public function fullAddress(): Attribute
    {
        return Attribute::make(
            get: function (mixed $value, array $attributes) {
                if ($attributes['gmaps_full_address']) {
                   return $attributes['gmaps_full_address'];
                }

                $state = State::query()->findOrFail($attributes['state_id']);
                $addressLine2 = !empty($attributes['address_line2']) ? $attributes['address_line2'] . ", " : '';

                return $attributes['address_line_1'] . ", "
                    . $addressLine2
                    . $attributes['city'] . ", "
                    . $state->name . ", "
                    . $attributes['postal_code']  ;
            }
        );
    }
}
