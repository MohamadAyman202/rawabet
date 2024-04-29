<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    public function state_data($id)
    {
        $country = Country::query()->findOrFail($id)->states;
        return response()->json(['data' => $country, 'status' => 200, 'msg' => 'Successfully Get State']);
    }

    public function city_data($country_id, $state_id)
    {
        $city = Country::query()->findOrFail($country_id)
            ->states->where('id', $state_id)->first()->cities;
        return response()->json(['data' => $city, 'status' => 200, 'msg' => 'Successfully Get Cities']);
    }
}
