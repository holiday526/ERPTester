<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReceiptType extends Model
{
    //
    protected $table = 'receipt_types';
    protected $fillable = ['description',];
}
