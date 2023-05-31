<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $fillable = [
        'category_id',
        'subcategory_name',
        'subcategory_slug',
        'subcategory_image',

    ];
    public function cat()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

}