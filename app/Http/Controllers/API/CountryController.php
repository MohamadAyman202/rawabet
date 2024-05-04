<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    public function state_data($id)
    {
        $country = Country::findOrFail($id)->states()->get();
        return response()->json(['data' => $country, 'status' => 200, 'msg' => 'Successfully Get State']);
    }

    public function city_data($country_id, $state_id)
    {
        $country = Country::findOrFail($country_id);

        $state = $country->states()
            ->where('id', $state_id)
            ->with('cities')
            ->firstOrFail();

        $city = $state->cities;
        return response()->json(['data' => $city, 'status' => 200, 'msg' => 'Successfully Get Cities']);
    }
}
