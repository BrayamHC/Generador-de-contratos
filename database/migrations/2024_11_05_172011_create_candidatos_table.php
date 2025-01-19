<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('candidatos', function (Blueprint $table) {
            $table->id(); // Esto crea un campo 'id' auto_increment y lo establece como clave primaria
            $table->string('nombre', 50)->unique();
            $table->string('apellido_paterno', 50)->unique();
            $table->string('apellido_materno', 50)->unique();
            $table->string('rfc', 13)->nullable();
            $table->string('curp', 18)->nullable();
            $table->integer('nss')->nullable(); // Eliminar auto_increment de aquí
            $table->string('direccion1', 50)->nullable();
            $table->string('direccion2', 50)->nullable();
            $table->string('estado', 50)->nullable();
            $table->string('ciudad', 50)->nullable();
            $table->integer('cp')->nullable(); // Eliminar auto_increment de aquí
            $table->string('pais', 50)->nullable();
            $table->string('puesto', 50)->nullable();
            $table->decimal('salario_diario', 8, 2)->nullable();
            $table->date('fecha_ingreso')->nullable();
            $table->string('correo_electronico', 50)->nullable();
            $table->string('status', 50)->nullable();
            $table->boolean('status_impresion')->default(0); // Campo adicional como booleano
            $table->timestamps();
        });
        
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('candidatos');
    }
};
