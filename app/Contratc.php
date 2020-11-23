<?php

namespace Laradev;

use Illuminate\Database\Eloquent\Model;

class Contratc extends Model
{
    protected $fillable = [
        'sale',
        'rent',
        'owner',
        'owner_spouse',
        'owner_company',
        'acquirer',
        'acquirer_spouse',
        'acquirer_company',
        'property',
        'sale_price',
        'rent_price',
        'price',
        'tribute',
        'condominium',
        'due_date',
        'deadline',
        'start_at'
     ];
}
