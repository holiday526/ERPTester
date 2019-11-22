<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumndateOnReceipts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('receipts', function (Blueprint $table) {
            $table->date('receipt_date')->after('expense')->default(date("Y-m-d"));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::table('receipts', function (Blueprint $table) {
            $table->dropColumn('receipt_date');
        });

    }
}
