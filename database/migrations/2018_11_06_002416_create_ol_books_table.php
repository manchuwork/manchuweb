<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOlBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //

        //
        Schema::create('ol_books', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 125)->index();
            $table->string('title_mnc', 512)->default('');
            $table->string('title_trans', 512)->default('');
            $table->string('subtitle',512)->default('');
            $table->string('author',125)->default('');
            $table->string('pic',512)->default('');
            $table->integer('user_id')->default(0);
            // 简介
            $table->text('brief_intro');
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
    }
}
