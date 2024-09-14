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
        Schema::create('fundings', function (Blueprint $table) {
            $table->id();
            $table->string(column: 'nama_bantuan');
            $table->bigInteger('total_bantuan');
            $table->string('sumber_bantuan');
            $table->timestamps();
        });

        Schema::create('school_fundings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_sekolah')
            ->references('id')->on('schools')
            ->constrained()
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->foreignId('id_bantuan')
            ->references('id')->on('fundings')
            ->constrained()
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fundings');
    }
};