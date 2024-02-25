<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'client_id',
        'value',
        'type_id',
        'date',
    ];

    public function type()
    {
        return $this->belongsTo(PaymentType::class, 'type_id');
    }
}
