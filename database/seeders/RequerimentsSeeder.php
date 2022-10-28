<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RequerimentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('requeriments')->insert([
            'name'      => 'Planilla de solicitud de Importación o (Re) Exportación de Fauna Silvestre y/o sus productos (disponible en www.minec.gob.ve).',
            'short_name'      => 'planilla_solicitud', //x
            'type'      => 'form',
        ]);
        
        DB::table('requeriments')->insert([
            'name'      => 'Timbres fiscales por 002 unidades tributarias.',
            'short_name'      => 'timbres_fiscales', //x
            'type'      => 'physical',
        ]);
        
        DB::table('requeriments')->insert([
            'name'      => 'Cédula de identidad (Copia Simple).',
            'short_name'      => 'cedula', //x
            'type'      => 'personal',
        ]);
        
        DB::table('requeriments')->insert([
            'name'      => 'Registro Único de Información Fiscal RIF (Copia Simple).',
            'short_name'      => 'rif', //x
            'type'      => 'web',
        ]);
        
        DB::table('requeriments')->insert([
            'name'      => 'Autorización para la instalación y funcionamiento de zoocriaderos con fines comerciales, emitida por el MINEC (Copia Simple).',
            'short_name'      => 'autorizacion_zoocriaderos', //x
            'type'      => 'web',
        ]);
        
        DB::table('requeriments')->insert([
            'name'      => 'Documentos demostrativos de la legalidad de la procedencia de los animales silvestres y/o de sus productos (Indispensable).',
            'short_name'      => 'documentos_especies',
            'type'      => 'web',
        ]);
        
        DB::table('requeriments')->insert([
            'name'      => 'Autorización para curtir pieles de la especie silvestre Caiman crocodylus (baba) y otras especies silvestres con aprovechamientos comerciales similares.',
            'short_name'      => 'autorizacion_curtir_pieles',
            'type'      => 'web',
        ]);
        
        DB::table('requeriments')->insert([
            'name'      => 'Guía(s) de Movilización (es) de canje y guía(s) de movilización canjeada(s), para animales vivos, muertos o de sus productos de especies silvestres distintas a las anteriores, con aprovechamientos comerciales diferentes.',
            'short_name'      => 'guia_movilizacion_canje',
            'type'      => 'web',
        ]);
        
        DB::table('requeriments')->insert([
            'name'      => 'Actas  de inspección de animales silvestres y/o sus productos a exportar.',
            'short_name'      => 'acta_inspeccion',
            'type'      => 'web',
        ]);
        
        DB::table('requeriments')->insert([
            'name'      => 'Informe(s) parcial(es) o total(es) de inspección(es) y/o de inventario(s) de los productos almacenados.',
            'short_name'      => 'informe_inventario_productos',
            'type'      => 'web',
        ]);
        
        DB::table('requeriments')->insert([
            'name'      => 'Informe(s) más reciente de inspección(es) y/o de inventario(s) de los animales por cada especie silvestre cautiva en el zoocriadero.',
            'short_name'      => 'informe_inventario_especies',
            'type'      => 'web',
        ]);
        
        DB::table('requeriments')->insert([
            'name'      => 'Documentos que avalen la propiedad y procedencia legal del(os) espécimen(es), distintos a los especificados.',
            'short_name'      => 'documentos_propiedad_especies',
            'type'      => 'web',
        ]);
        
        DB::table('requeriments')->insert([
            'name'      => 'Licencia para ejercer el comercio o industria de animales silvestres vivos, muertos y de sus productos,  emitida por el MINEC (Copia Simple).',
            'short_name'      => 'licencia_comercio_animales', //
            'type'      => 'web',
        ]);
        
        DB::table('requeriments')->insert([
            'name'      => 'Autorización a tercera persona (en caso que el solicitante no pueda realizar el trámite).',
            'short_name'      => 'autorizacion_tercera_persona', //x
            'type'      => 'web',
        ]);
        DB::table('requeriments')->insert([
            'name'      => 'Copia Del Permiso Cites De Importación', //x
            'short_name'      => 'import_permit_copy',
            'type'      => 'web',
        ]);
        DB::table('requeriments')->insert([
            'name'      => 'Copia del Contrato Acceso a los Recursos Genéticos Individual o Marco relacionados con los especímenes a exportar', //x
            'short_name'      => 'import_permit_copy',
            'type'      => 'web',
        ]);


        /**
         * recaudos 92 reexportacion
         */

        DB::table('requeriments')->insert([
            'name'      => 'Planilla de solicitud de exportación',
            'short_name'      => 'planilla_exportación',
            'type'      => 'web',
        ]);
        DB::table('requeriments')->insert([
            'name'      => 'Permiso Cites De Importación Expedido Por La Autoridad Administrativa Cites De Venezuela',
            'short_name'      => 'permiso_importacion_venezuela',
            'type'      => 'web',
        ]);
        DB::table('requeriments')->insert([
            'name'      => 'Licencia para ejercer el comercio e industria de animales silvestres, vivos, muertos o de sus productos (copia Simple).',
            'short_name'      => 'licencia_para_comercio_de_especies',
            'type'      => 'web',
        ]);
        DB::table('requeriments')->insert([
            'name'      => 'Autorización de Instalación y Funcionamiento de Zoocriadero (copia Simple).',
            'short_name'      => 'autorización_intalación_Zoocriaderos',
            'type'      => 'web',
        ]);
        DB::table('requeriments')->insert([
            'name'      => 'Permiso CITES de importación expedido por la Autoridad Administrativa CITES del país de destino (Copia Simple).',
            'short_name'      => 'permiso_CITES_importación_del_país_de_destino',
            'type'      => 'web',
        ]);
        DB::table('requeriments')->insert([
            'name'      => ' Permiso CITES de exportación(Original y Copia).',
            'short_name'      => 'permiso_CITES_importación_del_país_de_destino',
            'type'      => 'web',
        ]);
    }
}
