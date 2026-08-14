<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClientData extends Model
{
    protected $fillable = [
        'name',
        'type',
        'contact_person',
        'phone',
        'email',
        'case_category',
        'status',
        'address',
        'notes',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
