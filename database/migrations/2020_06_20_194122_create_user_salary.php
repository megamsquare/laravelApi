<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserSalary extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_salary', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('user')->onDelete('cascade');
            $table->enum('currency_type', ['naira', 'dollar', 'euro', 'pounds'])->default('naira');
            $table->decimal('basic', 13, 2)->nullable();
            $table->decimal('reimbursable', 13, 2)->nullable();
            $table->decimal('housing', 13, 2)->nullable();
            $table->decimal('transport', 13, 2)->nullable();
            $table->decimal('meal', 13, 2)->nullable();
            $table->decimal('medical', 13, 2)->nullable();
            $table->decimal('telephone', 13, 2)->nullable();
            $table->decimal('total', 13, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_salary');
    }
}
