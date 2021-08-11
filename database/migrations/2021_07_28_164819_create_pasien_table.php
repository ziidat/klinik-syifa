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
            $table->string('hp')->unique();
            $table->string('pendidikan');
            $table->string('no_bpjs')->nullable();
            $table->text('alergi')->nullable();
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
