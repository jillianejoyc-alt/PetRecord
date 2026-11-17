<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    protected $fillable = [
        'name',
        'type',
        'breed',
        'age',
        'gender',
        'owner_name',
        'contact_number',
        'address',
        'date_registered',
    ];

    protected function casts(): array
    {
        return [
            'age' => 'integer',
            'date_registered' => 'date',
        ];
    }
}