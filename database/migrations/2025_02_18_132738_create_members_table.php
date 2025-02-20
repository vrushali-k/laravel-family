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
            $table->id();
            $table->string('name', 50);
            $table->string('sirname', 50);
            $table->date('dob');
            $table->string('mobile_no', 10);
            $table->text('address');
            $table->string('state', 50);
            $table->string('city', 50);
            $table->string('pin_code', 6);
            $table->string('marital_status', 10);
            $table->date('wedding_date')->nullable();
            $table->string('photo', 100);
            $table->string('photo_dir', 100)->nullable()->change();
            $table->timestamps(); // Creates `created_at` & `updated_at` with default CURRENT_TIMESTAMP
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};
