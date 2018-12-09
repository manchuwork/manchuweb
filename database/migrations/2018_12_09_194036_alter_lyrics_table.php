<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterLyricsTable extends Migration
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
        Schema::table('lyrics', function (Blueprint $table) {

//            $table->string('title', 125)->index()->change();
//            $table->string('author', 125)->default('')->index()->change();
//            $table->string('file',125)->default('')->change();
            $table->string('file_mnc',125)->default('');

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
