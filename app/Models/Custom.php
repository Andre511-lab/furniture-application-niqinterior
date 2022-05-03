<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Custom extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name', 'email', 'address', 'phone', 'date', 'furniture_for',
        'furniture_type', 'reference_photo', 'description', 'location'
    ];
}
