<?php

namespace App\Models;

use App\Trait\FunctionsTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Translatable\HasTranslations;

class MeasuringUnit extends Model
{
    use HasFactory, HasTranslations, FunctionsTrait;

    protected $guarded = [];

    public $translatable = ['title', 'title_en'];

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function Fun($data)
    {
        return self::FormatDate($data);
    }

    public function Status($status)
    {
        return self::ChangeStatus($status);
    }
}
