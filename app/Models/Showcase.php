<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Showcase extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'description', 'url', 'categories_id'
    ];

    public function categories()
    {
        return $this->belongsTo(ProductCategory::class, 'categories_id', 'id');
    }
}
