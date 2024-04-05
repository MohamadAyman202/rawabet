<?php

namespace App\Trait;

use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use App\Models\Category;
use App\Models\Country;
use App\Models\MeasuringUnit;
use App\Models\SubCategory;
use App\Models\User;

trait FunctionsTrait
{
    public static function ChangeStatus($status): string
    {
        return match ($status) {
            'active'    => "btn btn-primary btn-sm",
            'inactive'  => "btn btn-danger btn-sm",
            default     => "Not Found",
        };
    }


    public static function CheckWorkingStatus($work_status): string
    {
        return match ($work_status) {
            "working"   => "btn btn-primary btn-sm",
            "enddate"   => "btn btn-warning btn-sm",
            "error"     => "btn btn-danger btn-sm",
            default     => "Not Found",
        };
    }

    public static function checkValuePayment($val): string
    {
        if ($val == null) {
            return "Success";
        }
        return "Failed";
    }

    public static function checkColorPayment($val): string
    {
        if ($val == null) {
            return "btn btn-primary btn-sm";
        }
        return "btn btn-danger btn-sm";
    }

    public static function FormatDate($date): string
    {
        return Carbon::parse($date)->format('Y-m-d g:i:s A');
    }

    public static function count_data()
    {
        return env('PAGINATE_COUNT');
    }

    public static function get_data_product(): array
    {
        $data['categories'] = Cache::remember('categories', 180, function () {
            return Category::query()->orderBy('created_at', 'DESC')->get();
        });

        $data['sub_categories'] = Cache::remember('sub_categories', 180, function () {
            return SubCategory::query()->orderBy('created_at', 'DESC')->get();
        });

        $data['measuring_units'] = Cache::remember('measuring_units', 180, function () {
            return MeasuringUnit::query()->orderBy('created_at', 'DESC')->get();
        });

        $data['countries'] = Cache::rememberForever('countries', function () {
            return Country::query()->orderBy('created_at', 'DESC')->get();
        });

        $data['users'] = Cache::remember('users', 180, function () {
            return User::query()->where('role_name', 'imported')->orderBy('created_at', 'DESC')->get();
        });

        return $data;
    }
}
