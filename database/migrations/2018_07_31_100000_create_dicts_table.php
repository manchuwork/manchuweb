<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDictsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('dicts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('manchu', 512)->unique();
            $table->string('trans',512);
            $table->string('trans_zh',512)->default('');
            $table->text('chinese');
            $table->string('pic',512);
            $table->integer('user_id')->default(0);
            $table->string('word_types',512);
            $table->tinyInteger('type')->default(1);
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
        //
        Schema::dropIfExists('dicts');
    }
}
