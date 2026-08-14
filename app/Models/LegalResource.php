<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LegalResource extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'effective_date' => 'date',
        'tags' => 'array',
        'year' => 'integer',
        'downloads_count' => 'integer',
    ];

    /**
     * Scope for keyword search across titles, numbers, abstract, and category.
     */
    public function scopeSearch($query, $search)
    {
        if ($search) {
            return $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('document_number', 'like', "%{$search}%")
                  ->orWhere('category', 'like', "%{$search}%")
                  ->orWhere('abstract', 'like', "%{$search}%");
            });
        }
        return $query;
    }
}
