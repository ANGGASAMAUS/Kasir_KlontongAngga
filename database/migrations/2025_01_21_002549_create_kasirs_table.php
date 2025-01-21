<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('kasir', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->string('nama'); // Nama kasir
            $table->string('email')->unique(); // Email unik
            $table->string('password'); // Password
            $table->timestamps(); // Created_at dan updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('kasir'); // Menghapus tabel kasir jika rollback
    }
};
