<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePasienTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pasien', function (Blueprint $table) {
            $table->id('id');
            $table->string('nama');
            $table->date('tgl_lhr');
            $table->string('pekerjaan');
            $table->string('jk');
            $table->text('alamat');
            $table->string('hp');
            $table->string('pendidikan');
            $table->string('no_bjs');
            $table->text('alergi');
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
        Schema::dropIfExists('pasien');
    }
}
