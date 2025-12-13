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
        Schema::create('transactions', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('user_id');
            $table->string('business_id');
            $table->uuid('ref_id');
            $table->double('amount')->nullable();
            $table->double('charge')->nullable();
            $table->string('routing_code')->nullable();
            $table->string('status')->nullable();
            $table->string('trx_type')->nullable();
            $table->string('type')->nullable();
            $table->uuid('card_id')->nullable();
            $table->uuid('gateway_id')->nullable();
            $table->string('bank_reference')->nullable();
            $table->text('description')->nullable();
            $table->text('decline_reason')->nullable();
            $table->string('acct_no')->nullable();
            $table->string('acct_name')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
};
