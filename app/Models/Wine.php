<?php

namespace App\Models;

use App\Traits\HasSlug;
use App\Services\UploadService;
use App\Traits\WithCurrencyFormatted;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use NumberFormatter;

class Wine extends Model
{
    use HasSlug, WithCurrencyFormatted;

    protected $fillable = [
        "name",
        "slug",
        "description",
        "year",
        "price",
        "stock",
        "image",
        "category_id"
    ];

    public function category() : BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    //Hacerlo un trait luego de entender como funciona //En el modelo category esta el otro que es igual
    public function imageUrl() : Attribute
    {
        return Attribute::make(
            get: fn() => UploadService::url($this->image)
        );
    }
    public function formattedPrice(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->formatCurrency($this->price)
        );
    }
}
