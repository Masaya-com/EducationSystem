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
    Schema::table('delivery_times', function (Blueprint $table) {
        $table->unsignedBigInteger('curriculum_id')->after('id');

        $table->foreign('curriculum_id')->references('id')->on('curriculums')->onDelete('cascade');
    });
    }

    public function down()
    {
    Schema::table('delivery_times', function (Blueprint $table) {
        $table->dropForeign(['curriculum_id']);
        $table->dropColumn('curriculum_id');
    });
    }
};
