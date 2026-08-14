<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category',
        'short_description',
        'base_price',
    ];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
