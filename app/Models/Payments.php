<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payments extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'subject_id',
        'plan_id',
        'customer_id',
        'payment_id',
        'status',
        'amount',
        'payment_type',
        'payment_gateway_id',
        'suscription_id'
    ];
}
