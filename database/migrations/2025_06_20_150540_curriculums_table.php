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
        Schema::create('curriculums', function (Blueprint $table) {
            $table->id(); // id INT(10) AUTO_INCREMENT PRIMARY KEY
            $table->string('title', 255); // VARCHAR(255)
            $table->string('thumbnail', 255); // VARCHAR(255)
            $table->longText('description'); // LONGTEXT
            $table->mediumText('video_url'); // MEDIUMTEXT
            $table->tinyInteger('alway_delivery_flg'); // TINYINT(4)
            $table->unsignedBigInteger('grade_id'); // INT(10)
            $table->timestamps(); // created_at & updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('curriculums');
    }
};
