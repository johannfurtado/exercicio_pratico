<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentType extends Model
{
    protected $fillable = [
        'name',
    ];

    public function payments()
    {
        return $this->hasMany(Payment::class, 'type_id');
    }
}
