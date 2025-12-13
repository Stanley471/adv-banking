<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->string('routing_type')->nullable(); 
            $table->string('payout')->nullable(); 
            $table->string('min_pl')->nullable(); 
            $table->string('max_pl')->nullable(); 
            $table->string('fiat_pc')->nullable(); 
            $table->string('percent_pc')->nullable(); 
            $table->string('pct')->nullable(); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('settings', function (Blueprint $table) {
            //
        });
    }
};
