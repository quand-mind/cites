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
            'slug' => 'el-proyecto',
            'is_onMenu' => true
        ]);

        factory(App\Page::class, 1)->create([
            'title' => 'Antecedentes',
            'slug' => 'antecedentes',
            'is_onMenu' => true,
            'is_subpage' => true,
            'main_page' => 1
        ]);
        
        factory(App\Page::class, 1)->create([
            'title' => 'Objetivos',
            'slug' => 'objetivos',
            'is_onMenu' => true,
            'is_subpage' => true,
            'main_page' => 1
        ]);

        factory(App\Page::class, 1)->create([
            'title' => 'Componentes',
            'slug' => 'componentes',
            'is_onMenu' => true,
            'is_subpage' => true,
            'main_page' => 1
        ]);

        factory(App\Page::class, 1)->create([
            'title' => 'Productos',
            'slug' => 'productos',
            'is_onMenu' => true,
            'is_subpage' => true,
            'main_page' => 1
        ]);

        // Protocolo de Cartagena
        factory(App\Page::class, 1)->create([
            'title' => 'Protocolo de Cartagena',
            'slug' => 'protocolo-de-cartagena',
            'is_onMenu' => true
        ]);

        factory(App\Page::class, 1)->create([
            'title' => 'El Protocolo',
            'slug' => 'el-protocolo',
            'is_onMenu' => true,
            'is_subpage' => true,
            'main_page' => 6
        ]);

        factory(App\Page::class, 1)->create([
            'title' => 'Linea de tiempo',
            'slug' => 'linea-de-tiempo',
            'is_onMenu' => true,
            'is_subpage' => true,
            'main_page' => 6
        ]);

        factory(App\Page::class, 1)->create([
            'title' => 'FAQs sobre el protocolo',
            'slug' => 'faqs-sobre-el-protocolo',
            'is_onMenu' => true,
            'is_subpage' => true,
            'main_page' => 6
        ]);

        // Legislación
        factory(App\Page::class, 1)->create([
            'title' => 'Legislación',
            'slug' => 'legislacion',
            'is_onMenu' => true
        ]);

        factory(App\Page::class, 1)->create([
            'title' => 'Legislación nacional',
            'slug' => 'legislacion-nacional',
            'is_onMenu' => true,
            'is_subpage' => true,
            'main_page' => 10
        ]);
        
        factory(App\Page::class, 1)->create([
            'title' => 'Legislación internacional',
            'slug' => 'legislacion-internacional',
            'is_onMenu' => true,
            'is_subpage' => true,
            'main_page' => 10
        ]);

         // Bioseguridad y Ambiente
        factory(App\Page::class, 1)->create([
            'title' => 'Bioseguridad y Ambiente',
            'slug' => 'bioseguridad-y-ambiente',
            'is_onMenu' => true
        ]);

        // Lab. Nacional de detección de OVM
        factory(App\Page::class, 1)->create([
            'title' => 'Lab. Nacional de detección de OVM',
            'slug' => 'lab-nacional-de-deteccion-de-ovm',
            'is_onMenu' => true
        ]);

        factory(App\Page::class, 1)->create([
            'title' => 'El laboratorio',
            'slug' => 'el-laboratorio',
            'is_onMenu' => true,
            'is_subpage' => true,
            'main_page' => 14
        ]);

        factory(App\Page::class, 1)->create([
            'title' => 'Capacitaciones',
            'slug' => 'capacitaciones',
            'is_onMenu' => true,
            'is_subpage' => true,
            'main_page' => 14
        ]);

        // Preguntas frecuentes
        factory(App\Page::class, 1)->create([
            'title' => 'Preguntas frecuentes',
            'slug' => 'preguntas-frecuentes',
            'is_onMenu' => true,
            'is_static' => true
        ]);

        // ¿Cómo participar?
        factory(App\Page::class, 1)->create([
            'title' => '¿Cómo participar?',
            'slug' => 'como-participar',
            'is_onMenu' => true
        ]);

        factory(App\Page::class, 1)->create([
            'title' => 'Encuestas',
            'slug' => 'encuestas',
            'is_onMenu' => true,
            'is_subpage' => true,
            'main_page' => 18
        ]);

        factory(App\Page::class, 1)->create([
            'title' => '¿Desea hacer una pregunta adicional?',
            'slug' => 'desea-hacer-una-pregunta-adicional',
            'is_onMenu' => true,
            'is_subpage' => true,
            'main_page' => 18
        ]);

        // Recursos
        factory(App\Page::class, 1)->create([
            'title' => 'Recursos',
            'slug' => 'recursos',
            'is_onMenu' => true
        ]);

        factory(App\Page::class, 1)->create([
            'title' => 'Portales de la temática',
            'slug' => 'portales-de-la-tematica',
            'is_onMenu' => true,
            'is_subpage' => true,
            'main_page' => 21
        ]);

        factory(App\Page::class, 1)->create([
            'title' => 'Formularios de solicitud',
            'slug' => 'formularios-de-solicitud',
            'is_onMenu' => true,
            'is_subpage' => true,
            'main_page' => 21
        ]);

        factory(App\Page::class, 1)->create([
            'title' => 'Glosario',
            'slug' => 'glosario',
            'is_onMenu' => true,
            'is_subpage' => true,
            'main_page' => 21,
            'is_static' => true
        ]);

        factory(App\Page::class, 1)->create([
            'title' => 'Acrónimos',
            'slug' => 'acronimos',
            'is_onMenu' => true,
            'is_subpage' => true,
            'main_page' => 21,
            'is_static' => true
        ]);

        factory(App\Page::class, 1)->create([
            'title' => 'Mapa del sitio',
            'slug' => 'mapa-del-sitio',
            'is_onMenu' => true,
            'is_subpage' => true,
            'main_page' => 21
        ]);

        DB::table('pages')->insert([
            'title'             => 'Bienvenido',
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
