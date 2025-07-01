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
        Schema::create('curriculum_progress', function (Blueprint $table) {
        $table->id(); // id INT AUTO_INCREMENT PRIMARY KEY
        $table->unsignedBigInteger('curriculums_id');
        $table->unsignedBigInteger('users_id');
        $table->tinyInteger('clear_flg')->default(0);
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
        Schema::dropIfExists('curricurum_progress');
    }
};
