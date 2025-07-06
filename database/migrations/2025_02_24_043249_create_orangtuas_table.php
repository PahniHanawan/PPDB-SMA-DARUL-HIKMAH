<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('orangtuas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_user')->constrained('users')->onDelete('cascade');

            // Data Ayah
            $table->string('nama_ayah');
            $table->string('nik_ayah', 16);
            $table->enum('status_ayah', ['Hidup', 'Meninggal']);
            $table->string('no_ayah', 15)->nullable();
            $table->string('tempat_lahir_ayah');
            $table->date('tgl_lahir_ayah');
            $table->string('agama_ayah', 20);
            $table->string('pekerjaan_ayah');
            $table->enum('penghasilan_ayah', [
                '0',
                'Kurang Dari 1.000.000',
                '1.000.000 - 3.000.000',
                '3.000.000 - 5.000.000',
                'Lebih Dari 5.000.000'
            ])->nullable();

            // Data Ibu
            $table->string('nama_ibu');
            $table->string('nik_ibu', 16);
            $table->enum('status_ibu', ['Hidup', 'Meninggal']);
            $table->string('no_ibu', 15)->nullable();
            $table->string('tempat_lahir_ibu');
            $table->date('tgl_lahir_ibu');
            $table->string('agama_ibu', 20);
            $table->string('pekerjaan_ibu');
            $table->enum('penghasilan_ibu', [
                '0',
                'Kurang Dari 1.000.000',
                '1.000.000 - 3.000.000',
                '3.000.000 - 5.000.000',
                'Lebih Dari 5.000.000'
            ])->nullable();
            $table->string('alamat_orangtua')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('orangtuas');
    }
};
