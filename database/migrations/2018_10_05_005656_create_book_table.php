<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('books', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 125)->index();
            $table->string('title_mnc', 512)->default('');
            $table->string('subtitle',512)->default('');
            $table->string('author',125)->default('');
            $table->string('translator',512)->default('');
            $table->string('publisher',125)->default('');
            $table->string('publish_year',15)->default('');
            $table->integer('page_count')->default(0);
            $table->integer('price')->default(0);
            $table->string('binding',15)->default('');
            $table->string('isbn',15)->default('');
            $table->string('pic',512)->default('');
            $table->integer('user_id')->default(0);
            // 简介
            $table->text('brief_intro')->default('');
            // 作者简介
            $table->text('about_the_author')->default('');
            // 目录
            $table->text('catalogue')->default('');

            // 是否有线上关联图书id
            $table->integer('ol_book_id')->default(0);
            // 外链内容路径 github-raw-path pdf阅读器 html
            $table->string('external_git_path',512)->default('');
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
