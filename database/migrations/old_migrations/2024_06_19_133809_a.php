<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('members', function (Blueprint $table) {
            $table->bigIncrements('id')->primary();
            $table->text('name');
            $table->text('sex')->nullable();
            $table->dateTime('dob');
            $table->dateTime('created_at')->nullable();
            $table->dateTime('end')->nullable();
            $table->text('contact');
            $table->text('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        
    }
};