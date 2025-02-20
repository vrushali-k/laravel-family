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
        Schema::create('member_details', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->date('dob');
            $table->string('marital_status', 10);
            $table->date('wedding_date')->nullable();
            $table->string('education', 50);
            $table->string('photo', 255)->nullable();
            $table->string('photo_dir', 255)->nullable();
            $table->timestamps(); // Creates `created_at` & `updated_at` with default CURRENT_TIMESTAMP
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('member_details');
    }
};
