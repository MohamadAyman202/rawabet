<?php

namespace App\Models;

use App\Trait\FunctionsTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Slider extends Model
{
    use HasFactory, HasTranslations, FunctionsTrait;

    protected $guarded = [];
    public $translatable = ['title', 'title_en', 'description', 'description_en'];

    public function Fun($data)
    {
        return self::FormatDate($data);
    }

    public function Status($status)
    {
        return self::ChangeStatus($status);
    }
}
