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
        Schema::create('delivery_times', function (Blueprint $table) {
            $table->id(); // id INT(10) AUTO_INCREMENT PRIMARY KEY
            $table->unsignedBigInteger('curriculums_id'); // INT(10)
            $table->dateTime('delivery_from'); // DATETIME
            $table->dateTime('delivery_to');   // DATETIME
            $table->timestamps(); // created_at & updated_at

            });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('delivery_times');
    }
};
