<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOlCatalogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('ol_catalogs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('ol_book_id')->default(0);
            // 目录项
            $table->string('entry', 125)->index();
            // 目录项
            $table->string('entry_mnc', 512)->default('');
            // 目录项 转写
            $table->string('entry_trans', 512)->default('');
            $table->integer('user_id')->default(0);
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
