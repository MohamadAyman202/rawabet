<?php

namespace App\Models;

use App\Trait\FunctionsTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory, FunctionsTrait;
    protected $guarded = [];

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }
    public function subscription()
    {
        return $this->belongsTo(Subscription::class);
    }

    public function Fun($date)
    {
        return self::FormatDate($date);
    }

    public function checkValue($val)
    {
        return self::checkValuePayment($val);
    }

    public function checkColor($val)
    {
        return self::checkColorPayment($val);
    }


    public function working_status($work_status)
    {
        return self::CheckWorkingStatus($work_status);
    }
}
