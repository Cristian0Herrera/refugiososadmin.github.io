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
        Schema::create('refugiados', function (Blueprint $table) {
            $table->id();
            $table->string('nombre')->nullable();
            $table->string('fechaNacimiento')->nullable();
            $table->string('genero')->nullable();
            $table->string('dui')->nullable();
            $table->string('telefono')->nullable();
            $table->string('fechaIngreso')->nullable();
            $table->string('nunPersonasFamiliar')->nullable();
            $table->string('condicionSalud')->nullable();
            $table->string('albergueAsignado')->nullable();
            $table->string('observaciones')->nullable();
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('refugiados');
    }
};
