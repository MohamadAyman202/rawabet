<?php

namespace App\Models;

use App\Trait\FunctionsTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Translatable\HasTranslations;

class Subscription extends Model
{
    use HasFactory, HasTranslations, FunctionsTrait;
    protected $guarded = [];
    public $translatable = ['title', 'title_en', 'description', 'description_en'];

    public function admin(): BelongsTo
    {
        return $this->belongsTo(Admin::class);
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
