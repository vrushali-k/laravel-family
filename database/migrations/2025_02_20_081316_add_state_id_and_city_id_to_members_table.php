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
        Schema::table('members', function (Blueprint $table) {
            /*$table->unsignedBigInteger('state_id')->after('address');
			$table->unsignedBigInteger('city_id')->after('state_id');*/
			
			$table->foreignId('state_id')->after('address');
			$table->foreignId('city_id')->after('state_id');

			// Foreign keys
			/*$table->foreign('state_id')->references('id')->on('states')->constrained();
			$table->foreign('city_id')->references('id')->on('cities')->constrained();*/
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('members', function (Blueprint $table) {
             $table->dropForeign(['state_id']);
			$table->dropForeign(['city_id']);
			$table->dropColumn(['state_id', 'city_id']);
        });
    }
};
