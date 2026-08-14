<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IncomingMail extends Model
{
    protected $fillable = [
        'reference_number', 'mail_date', 'type', 'sender', 
        'client_data_id', 'case_category', 'user_id', 
        'status', 'description', 'document_url'
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
