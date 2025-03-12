<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    use HasFactory;

    protected $table = 'empleados';
    /**
     * Los atributos que son asignables en masa.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nombre',
        'apellido_paterno',
        'apellido_materno',
        'rfc',
        'curp',
        'nss',
        'direccion1',
        'direccion2',
        'estado',
        'ciudad',
        'cp',
        'pais',
        'puesto',
        'salario_diario',
        'fecha_ingreso',
        'correo_electronico',
        'status',
    ];

    /**
     * Los atributos que deben ser ocultos para la serialización.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        // Aquí puedes incluir atributos que no quieres que se muestren al serializar el modelo (si es necesario)
    ];

    /**
     * Los atributos que deben ser convertidos a un tipo específico.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'fecha_ingreso' => 'datetime',
        // Puedes añadir más campos si es necesario para conversiones automáticas
    ];
}
