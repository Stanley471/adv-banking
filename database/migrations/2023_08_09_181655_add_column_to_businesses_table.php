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
        Schema::table('businesses', function (Blueprint $table) {
            $table->string('financial_statement')->nullable();
            $table->string('g_first_name')->nullable();
            $table->string('g_last_name')->nullable();
            $table->string('g_email')->nullable();
            $table->string('g_mobile')->nullable();
            $table->string('g_address')->nullable();
            $table->string('g_mobile_code')->nullable();
            $table->string('g_doc_type')->nullable();
            $table->string('g_doc_number')->nullable();
            $table->string('g_doc_front')->nullable();
            $table->string('g_doc_back')->nullable();
            $table->string('g_proof_of_address')->nullable();
            $table->string('loan_status')->default('pending')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('businesses', function (Blueprint $table) {
            //
        });
    }
};
