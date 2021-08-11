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
        ]);
        
        DB::table('requeriments')->insert([
            'name'      => 'Timbres fiscales por 002 unidades tributarias.',
        ]);
        
        DB::table('requeriments')->insert([
            'name'      => 'Cédula de identidad (Copia Simple).',
        ]);
        
        DB::table('requeriments')->insert([
            'name'      => 'Registro Único de Información Fiscal RIF (Copia Simple).',
        ]);
        
        DB::table('requeriments')->insert([
            'name'      => 'Autorización para la instalación y funcionamiento de zoocriaderos con fines comerciales, emitida por el MINEC (Copia Simple).',
        ]);
        
        DB::table('requeriments')->insert([
            'name'      => 'Documentos demostrativos de la legalidad de la procedencia de los animales silvestres y/o de sus productos (Indispensable).',
        ]);
        
        DB::table('requeriments')->insert([
            'name'      => 'Autorización para curtir pieles de la especie silvestre Caiman crocodylus (baba) y otras especies silvestres con aprovechamientos comerciales similares.',
        ]);
        
        DB::table('requeriments')->insert([
            'name'      => 'Guía(s) de Movilización (es) de canje y guía(s) de movilización canjeada(s), para animales vivos, muertos o de sus productos de especies silvestres distintas a las anteriores, con aprovechamientos comerciales diferentes.',
        ]);
        
        DB::table('requeriments')->insert([
            'name'      => 'Actas  de inspección de animales silvestres y/o sus productos a exportar.',
        ]);
        
        DB::table('requeriments')->insert([
            'name'      => 'Informe(s) parcial(es) o total(es) de inspección(es) y/o de inventario(s) de los productos almacenados.',
        ]);
        
        DB::table('requeriments')->insert([
            'name'      => 'Informe(s) más reciente de inspección(es) y/o de inventario(s) de los animales por cada especie silvestre cautiva en el zoocriadero.',
        ]);
        
        DB::table('requeriments')->insert([
            'name'      => 'Informe(s) más reciente de inspección(es) y/o de inventario(s) de los animales por cada especie silvestre cautiva en el zoocriadero.',
        ]);
        
        DB::table('requeriments')->insert([
            'name'      => 'Licencia para ejercer el comercio o industria de animales silvestres vivos, muertos y de sus productos,  emitida por el MINEC (Copia Simple).',
        ]);
        
        DB::table('requeriments')->insert([
            'name'      => 'Autorización a tercera persona (en caso que el solicitante no pueda realizar el trámite).',
        ]);
    }
}
