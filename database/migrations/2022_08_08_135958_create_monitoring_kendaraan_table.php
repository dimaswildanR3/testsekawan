<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMonitoringKendaraanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('monitoring_kendaraan', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('id_driver')->constrained('driverr')->onDelete('cascade')->onUpdate('cascade');
            $table->enum('jeniskendaraan', ['angkutan orang','angkutan barang']);
            $table->enum('Bahanbakar', ['Bensin','Solar','Pertalite','Pertamax','Pertamax Dex' ]);
            $table->integer('BBM');
            $table->date('jadwalservice');
            $table->date('pemakaian');
            $table->date('pengembalian');
            $table->enum('persetujuan', ['setuju','tidaksetuju']);
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
        Schema::dropIfExists('monitoring_kendaraan');
    }
}
