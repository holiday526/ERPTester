<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Receipt extends Model
{
    //
    protected $table = 'receipts';
    protected $fillable = ['description', 'remarks', 'receipt_type_id', 'user_id', 'vendor_id'];
}
