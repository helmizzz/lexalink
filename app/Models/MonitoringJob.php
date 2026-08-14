<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MonitoringJob extends Model
{
    protected $fillable = [
        'name', 'description', 'client_data_id', 'user_id', 
        'priority', 'status', 'start_date', 'due_date'
    ];

    public function clientData()
    {
        return $this->belongsTo(ClientData::class);
    }

    public function pic()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
