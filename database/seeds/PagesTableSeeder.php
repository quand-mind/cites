<?php

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
        factory(App\Page::class, 1)->create([
            'title' => 'El Proyecto',
            'is_onMenu' => true
        ]);

        factory(App\Page::class, 1)->create([
            'title' => 'Antecedentes',
            'is_onMenu' => true,
            'is_subpage' => true,
            'main_page' => 1
        ]);
        
        factory(App\Page::class, 1)->create([
            'title' => 'Objetivos',
            'is_onMenu' => true,
            'is_subpage' => true,
            'main_page' => 1
        ]);

        factory(App\Page::class, 1)->create([
            'title' => 'Componentes',
            'is_onMenu' => true,
            'is_subpage' => true,
            'main_page' => 1
        ]);

        factory(App\Page::class, 1)->create([
            'title' => 'Productos',
            'is_onMenu' => true,
            'is_subpage' => true,
            'main_page' => 1
        ]);

        // Protocolo de Cartagena
        factory(App\Page::class, 1)->create([
            'title' => 'Protocolo de Cartagena',
            'is_onMenu' => true
        ]);

        factory(App\Page::class, 1)->create([
            'title' => 'El Protocolo',
            'is_onMenu' => true,
            'is_subpage' => true,
            'main_page' => 6
        ]);

        factory(App\Page::class, 1)->create([
            'title' => 'Linea de tiempo',
            'is_onMenu' => true,
            'is_subpage' => true,
            'main_page' => 6
        ]);

        factory(App\Page::class, 1)->create([
            'title' => 'FAQs sobre el protocolo',
            'is_onMenu' => true,
            'is_subpage' => true,
            'main_page' => 6
        ]);

        // Legislación
        factory(App\Page::class, 1)->create([
            'title' => 'Legislación',
            'is_onMenu' => true
        ]);

        factory(App\Page::class, 1)->create([
            'title' => 'Legislación nacional',
            'is_onMenu' => true,
            'is_subpage' => true,
            'main_page' => 10
        ]);
        
        factory(App\Page::class, 1)->create([
            'title' => 'Legislación internacional',
            'is_onMenu' => true,
            'is_subpage' => true,
            'main_page' => 10
        ]);

         // Bioseguridad y Ambiente
        factory(App\Page::class, 1)->create([
            'title' => 'Bioseguridad y Ambiente',
            'is_onMenu' => true
        ]);

        // Lab. Nacional de detección de OVM
        factory(App\Page::class, 1)->create([
            'title' => 'Lab. Nacional de detección de OVM',
            'is_onMenu' => true
        ]);

        factory(App\Page::class, 1)->create([
            'title' => 'El laboratorio',
            'is_onMenu' => true,
            'is_subpage' => true,
            'main_page' => 14
        ]);

        factory(App\Page::class, 1)->create([
            'title' => 'Capacitaciones',
            'is_onMenu' => true,
            'is_subpage' => true,
            'main_page' => 14
        ]);

        // Preguntas frecuentes
        factory(App\Page::class, 1)->create([
            'title' => 'Preguntas frecuentes',
            'is_onMenu' => true,
            'is_static' => true
        ]);

        // ¿Cómo participar?
        factory(App\Page::class, 1)->create([
            'title' => '¿Cómo participar?',
            'is_onMenu' => true
        ]);

        factory(App\Page::class, 1)->create([
            'title' => 'Encuesta',
            'is_onMenu' => true,
            'is_subpage' => true,
            'main_page' => 18
        ]);

        factory(App\Page::class, 1)->create([
            'title' => '¿Desea hacer una pregunta adicional?',
            'is_onMenu' => true,
            'is_subpage' => true,
            'main_page' => 18
        ]);

        // Recursos
        factory(App\Page::class, 1)->create([
            'title' => 'Recursos',
            'is_onMenu' => true
        ]);

        factory(App\Page::class, 1)->create([
            'title' => 'Portales de la temática',
            'is_onMenu' => true,
            'is_subpage' => true,
            'main_page' => 21
        ]);

        factory(App\Page::class, 1)->create([
            'title' => 'Formularios de solicitud',
            'is_onMenu' => true,
            'is_subpage' => true,
            'main_page' => 21
        ]);

        factory(App\Page::class, 1)->create([
            'title' => 'Glosario',
            'is_onMenu' => true,
            'is_subpage' => true,
            'main_page' => 21,
            'is_static' => true
        ]);

        factory(App\Page::class, 1)->create([
            'title' => 'Acrónimos',
            'is_onMenu' => true,
            'is_subpage' => true,
            'main_page' => 21,
            'is_static' => true
        ]);

        factory(App\Page::class, 1)->create([
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
