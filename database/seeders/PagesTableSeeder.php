<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class PagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // El proyecto
        Page::factory()->create([
            'title' => 'El Proyecto',
            'is_onMenu' => true
        ]);

        Page::factory()->create([
            'title' => 'Antecedentes',
            'is_onMenu' => true,
            'is_subpage' => true,
            'main_page' => 1
        ]);
        
        Page::factory()->create([
            'title' => 'Objetivos',
            'is_onMenu' => true,
            'is_subpage' => true,
            'main_page' => 1
        ]);

        Page::factory()->create([
            'title' => 'Componentes',
            'is_onMenu' => true,
            'is_subpage' => true,
            'main_page' => 1
        ]);

        Page::factory()->create([
            'title' => 'Productos',
            'is_onMenu' => true,
            'is_subpage' => true,
            'main_page' => 1
        ]);

        // Protocolo de Cartagena
        Page::factory()->create([
            'title' => 'Protocolo de Cartagena',
            'is_onMenu' => true
        ]);

        Page::factory()->create([
            'title' => 'El Protocolo',
            'is_onMenu' => true,
            'is_subpage' => true,
            'main_page' => 6
        ]);

        Page::factory()->create([
            'title' => 'Linea de tiempo',
            'is_onMenu' => true,
            'is_subpage' => true,
            'main_page' => 6
        ]);

        Page::factory()->create([
            'title' => 'FAQs sobre el protocolo',
            'is_onMenu' => true,
            'is_subpage' => true,
            'main_page' => 6
        ]);

        // Legislación
        Page::factory()->create([
            'title' => 'Legislación',
            'is_onMenu' => true
        ]);

        Page::factory()->create([
            'title' => 'Legislación nacional',
            'is_onMenu' => true,
            'is_subpage' => true,
            'main_page' => 10
        ]);
        
        Page::factory()->create([
            'title' => 'Legislación internacional',
            'is_onMenu' => true,
            'is_subpage' => true,
            'main_page' => 10
        ]);

         // Bioseguridad y Ambiente
        Page::factory()->create([
            'title' => 'Bioseguridad y Ambiente',
            'is_onMenu' => true
        ]);

        // Lab. Nacional de detección de OGM
        Page::factory()->create([
            'title' => 'Lab. Nacional de detección de OGM',
            'is_onMenu' => true
        ]);

        Page::factory()->create([
            'title' => 'El laboratorio',
            'is_onMenu' => true,
            'is_subpage' => true,
            'main_page' => 14
        ]);

        Page::factory()->create([
            'title' => 'Capacitaciones',
            'is_onMenu' => true,
            'is_subpage' => true,
            'main_page' => 14
        ]);

        // Preguntas frecuentes
        Page::factory()->create([
            'title' => 'Preguntas frecuentes',
            'is_onMenu' => true,
            'is_static' => true
        ]);

        // ¿Cómo participar?
        Page::factory()->create([
            'title' => '¿Cómo participar?',
            'is_onMenu' => true
        ]);

        Page::factory()->create([
            'title' => 'Encuestas',
            'is_onMenu' => true,
            'is_subpage' => true,
            'main_page' => 18
        ]);

        Page::factory()->create([
            'title' => '¿Desea hacer una pregunta adicional?',
            'is_onMenu' => true,
            'is_subpage' => true,
            'main_page' => 18
        ]);

        // Recursos
        Page::factory()->create([
            'title' => 'Recursos',
            'is_onMenu' => true
        ]);

        Page::factory()->create([
            'title' => 'Portales de la temática',
            'is_onMenu' => true,
            'is_subpage' => true,
            'main_page' => 21
        ]);

        Page::factory()->create([
            'title' => 'Formularios de solicitud',
            'is_onMenu' => true,
            'is_subpage' => true,
            'main_page' => 21
        ]);

        Page::factory()->create([
            'title' => 'Glosario',
            'is_onMenu' => true,
            'is_subpage' => true,
            'main_page' => 21,
            'is_static' => true
        ]);

        Page::factory()->create([
            'title' => 'Acrónimos',
            'is_onMenu' => true,
            'is_subpage' => true,
            'main_page' => 21,
            'is_static' => true
        ]);

        Page::factory()->create([
            'title' => 'Mapa del sitio',
            'is_onMenu' => true,
            'is_subpage' => true,
            'main_page' => 21
        ]);

        DB::table('pages')->insert([
            'title'             => 'Bienvenidos',
            'slug'              => '',
            'meta_description'  => 'Descripción del sitio',
            'meta_keywords'     => 'Palabras claves',
            'is_active'         => true,
            'is_static'         => true,
            'is_onMenu'         => false,
            'created_by'        => 1,
            'lastModified_by'   => 1,
            'content'           => 'Modifique el contenido en el panel de administración'
        ]);
    }
}
