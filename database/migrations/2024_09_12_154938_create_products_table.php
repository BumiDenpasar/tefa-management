<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_sekolah')
            ->references('id')->on('schools')
            ->constrained()
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->string('nama_produk');
            $table->bigInteger('harga_produk');
            $table->integer('total_jual');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
