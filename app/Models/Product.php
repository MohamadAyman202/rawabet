<?php

namespace App\Models;

use App\Models\Scopes\ActiveDataScope;
use App\Trait\FunctionsTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Notifications\Notifiable;
use Spatie\Translatable\HasTranslations;

class Product extends Model
{
    use HasFactory, HasTranslations, FunctionsTrait, Notifiable;
    protected $guarded = [];
    public $translatable = ['title', 'title_en', 'meta_description', 'meta_description_en', 'description', 'description_en'];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function sub_category(): BelongsTo
    {
        return $this->belongsTo(SubCategory::class);
    }

    public function measuring_unit(): BelongsTo
    {
        return $this->belongsTo(MeasuringUnit::class);
    }

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    public function admin(): BelongsTo
    {
        return $this->belongsTo(Admin::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function Fun($data)
    {
        return self::FormatDate($data);
    }

    public function Status($status)
    {
        return self::ChangeStatus($status);
    }

    // protected static function booted() {
    //     static::addGlobalScope(new ActiveDataScope);
    // }
}
