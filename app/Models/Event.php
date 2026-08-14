<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'event_date',
        'event_time',
        'location_type',
        'location',
        'description',
        'cover_image',
        'gallery',
        'registration_link',
        'status',
    ];

    protected $casts = [
        'event_date' => 'date',
        'gallery' => 'array',
    ];

    /**
     * Users (clients) registered for this event
     */
    public function attendees()
    {
        return $this->belongsToMany(User::class, 'event_registrations')
                    ->withPivot('registered_at');
    }
}
