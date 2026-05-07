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
        Schema::create('patients', function (Blueprint $table) {
            $table->id('patient_id'); 
            
            // Foreign Key linking to the users table
            $table->foreignId('user_id')->references('user_id')->on('users')->onDelete('cascade');
            
            $table->string('first_name');
            $table->string('last_name');
            $table->string('contact_no')->nullable();
            $table->date('birth_date')->nullable();
            $table->string('sex')->nullable();
            $table->text('address')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};
