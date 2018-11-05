<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateBooksTable extends Migration
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
        Schema::table('books', function (Blueprint $table) {

            // 是否有线上关联图书id
            $table->integer('ol_book_id')->default(0);
            // 外链内容路径 github-raw-path pdf阅读器 html
            $table->string('ext_file_path',512)->default('');
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
