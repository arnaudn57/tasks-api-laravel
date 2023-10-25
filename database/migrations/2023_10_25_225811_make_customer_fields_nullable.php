<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MakeCustomerFieldsNullable extends Migration
{
    public function up()
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->string('customer_name')->nullable()->change();
            $table->string('customer_email')->nullable()->change();
            $table->string('customer_phone')->nullable()->change();
            $table->string('customer_address')->nullable()->change();
            $table->string('customer_city')->nullable()->change();
            $table->string('customer_state')->nullable()->change();
            $table->string('customer_zip')->nullable()->change();
            $table->string('customer_country')->nullable()->change();
            $table->string('customer_status')->nullable()->change();
        });
    }

    public function down()
    {
        // Revert the changes if needed
    }
}
