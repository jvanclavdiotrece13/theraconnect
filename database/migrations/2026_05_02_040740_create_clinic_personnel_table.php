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
        Schema::create('clinic_personnel', function (Blueprint $table) {
            $table->id('personnel_id'); 
            
            // Foreign Key linking to the users table
            $table->foreignId('user_id')->references('user_id')->on('users')->onDelete('cascade');
            
            $table->string('full_name');
            $table->string('role_title'); 
            $table->string('contact_no')->nullable();
            $table->string('access_level'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clinic_personnel');
    }
};
