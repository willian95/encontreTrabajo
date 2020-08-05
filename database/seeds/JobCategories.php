<?php

use Illuminate\Database\Seeder;

class JobCategories extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        DB::table("job_categories")->insertOrIgnore([
            ["name" => "Administración"],
            ["name" => "Almacenamiento"],
            ["name" => "Atención de Clientes"], 
            ["name" => "Arte / Diseño"],
            ["name" => "Call-Center"],
            ["name" => "Calidad"],
            ["name" => "Compras / Comercio Exterior"],
            ["name" => "Comunicaciones"],
            ["name" => "Contabilidad"],
            ["name" => "Construcción"],
            ["name" => "Directores"],
            ["name" => "Docentes / Educadores"], 
            ["name" => "Enfermería"],
            ["name" => "Gerentes"],
            ["name" => "Hotelería"],
            ["name" => "Informática"],
            ["name" => "Ingeniería"],
            ["name" => "Investigación"], 
            ["name" => "Logística"],
            ["name" => "Manufactura"],
            ["name" => "Mantenimiento"], 
            ["name" => "Marketing"],
            ["name" => "Medicina"],
            ["name" => "Mercadotecnia"], 
            ["name" => "Minería"],
            ["name" => "Obras"],
            ["name" => "Operarios / Operadores"], 
            ["name" => "Producción"],
            ["name" => "Publicidad"],
            ["name" => "Recursos Humanos"],
            ["name" => "Reparaciones"],
            ["name" => "Tecnicos"],
            ["name" => "Tele-comunicaciones"],
            ["name" => "Tele-mercadeo"],
            ["name" => "Transporte"],
            ["name" => "Turismo"],
            ["name" => "Ventas"],
            ["name" => "Servicios Generales, Aseo y Seguridad"],
            ["name" => "Otros"]
        ]);

    }
}
