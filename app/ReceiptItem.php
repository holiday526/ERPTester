<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReceiptItem extends Model
{
    //
    protected $table = 'receipt_items';
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'receipt_id', 'description', 'data'];
}
