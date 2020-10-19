<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuestionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('questions')->insert([
            'question'      => '¿Qué es un Organismo Genéticamente Modificado?',
            'answer'     => 'Un organismo genéticamente modificado (OGM) es un ser vivo (planta,
            animal, hongo o bacteria) al que se le ha modificado uno o varios genes, por medio de técnicas de ingeniería genética (ArgenBio, 2007). 
            ',
            'asked_by'  => 'admin',
            'is_faq'  => true,
            'answered_by'      => 1
        ]);
        DB::table('questions')->insert([
            'question'      => '¿Qué es un gen?',
            'answer'     => 'El gen es la unidad física básica de la herencia, que contienen la
            información necesaria para precisar los rasgos transmisibles de padres a
            hijos. Los genes le indican al organismo cómo producir proteínas
            específicas, determinando las partes del cuerpo y sus funciones (NIH, s.f.;
            Medline, 2017).
            Los genes están dispuestos, en estructuras llamadas cromosomas, que
            contienen moléculas de ADN (ácido desoxiribonucléico). Los seres
            humanos tienen alrededor de 20.000 genes organizados en 46
            cromosomas (NIH, s.f.). Muchas características personales, como la
            estatura, dependen de la combinación de varios genes, mientras que otros
            rasgos, como ciertas enfermedades, dependen de un solo gen. La
            composición genética de un individuo se llama genotipo (Medline, 2017).',
            'asked_by'  => 'admin',
            'is_faq'  => true,
            'answered_by'      => 1
        ]);
        DB::table('questions')->insert([
            'question'      => '¿Qué es el ADN?',
            'answer'     => 'El ADN es una molécula que contiene las instrucciones biológicas
            codificadoras de la información celular de cada ser vivo, necesarias para
            desarrollarse, sobrevivir y reproducirse, y que se transmiten de los
            organismos adultos a su descendencia durante la reproducción (NIH,
            2015).
            El ADN se almacena generalmente en los núcleos de las células, y se
            conforma de unas sustancias químicas básicas llamadas nucleótidos
            (adenina, guanina, timina y citosina) que se unen formando cadenas, lo
            que le da al ADN su característica forma de espiral de doble hélice (NIH,
            2015; ArgenBio, 2007).',
            'asked_by'  => 'admin',
            'is_faq'  => true,
            'answered_by'      => 1
        ]);
        DB::table('questions')->insert([
            'question'      => '¿Qué es el proyecto genoma humano?',
            'answer'     => 'Un genoma es una colección completa de ácido desoxirribonucleico (ADN)
            de un organismo, que contiene la totalidad del material genético que posee
            un individuo o una especie en particular (RAE, 2018).
            El proyecto genoma, fue un esfuerzo internacional conjunto, de
            aproximadamente 13 años de duración, para desarrolla un mapa de la
            totalidad de los genes humanos (NIH, 2016), con la colaboración de USA,
            Inglaterra, Japón, Francia, Alemania, China y otros países.
            Entre sus objetivos estuvo: identificar los cerca de 20.500 genes en el
            ADN humano, determinar las secuencia de los 3 billones de pares de
            bases que lo conforman, registrar dicha información en bases de datos
            con herramientas de análisis mejoradas y manejar las implicaciones
            éticas, legales, económicas y sociales que de dicho proyecto se
            derivaran (HGP, 2017). ',
            'asked_by'  => 'admin',
            'is_faq'  => true,
            'answered_by'      => 1
        ]);
        DB::table('questions')->insert([
            'question'      => '¿Qué es la biotecnología?',
            'answer'     => 'La biotecnología consiste en el uso de tecnologías para manipular
            sistemas biológicos y organismos vivos o sus derivados, para la creación o
            modificación de productos y procesos, según explica el Convenio sobre la
            Diversidad Biológica -CBD (1992).
            A partir del CDB, se desarrolló en 2000 el Protocolo de Cartagena sobre
            Seguridad de la Biotecnología, que es un acuerdo internacional con el fin
            de normar sobre la conservación y uso sustentable de la diversidad
            biológica y la participación en los beneficios que deriven del uso de
            recursos genéticos (CBD, 2012), acuerdo al que se adhieren múltiples
            naciones, entre ellas Venezuela.',
            'asked_by'  => 'admin',
            'is_faq'  => true,
            'answered_by'      => 1
        ]);
        DB::table('questions')->insert([
            'question'      => '¿Qué es la transgénesis?',
            'answer'     => 'La biotecnología incluye diversas disciplinas, que incluyen la ingeniería
            genética: la tecnología que permite tener ADNr (recombinante), es decir, la
            manipulación deliberada del material genético con diferentes fines
            (CBUDEC, s.f.)
            Dentro de la ingeniería genética existen las técnicas de transgénesis, que
            implican la introducción de una o más secuencias de ADN de una especie
            a otra, por medios artificiales (NIH, s.f.).
            Cuando se habla de alimentos transgénicos se hace referencia a
            alimentos provenientes de cultivos vegetales y productos animales,
            modificados genéticamente (incluyendo el empleo de enzimas y aditivos
            obtenidos de microorganismos transgénicos en la elaboración y
            procesamiento de los alimentos), según señala ArgenBio (2007).',
            'asked_by'  => 'admin',
            'is_faq'  => true,
            'answered_by'      => 1
        ]);
        DB::table('questions')->insert([
            'question'      => '¿Cuáles son las ventajas para las personas de los OGM?',
            'answer'     => 'Entre las ventajas que pueden derivar de la manipulación genética de
            organismos, la FAO (2003) señala que ha permitido ampliar la
            investigación de enfermedades. Se espera poder aplicar la biotecnología 
            en los procesos de vacunación y producción de medicamentos; mejorar el
            valor nutritivo de los alimentos y finalmente, la caracterización y posible
            eliminación de genes alergénicos, son algunos de los potenciales usos de
            la biotecnología.',
            'asked_by'  => 'admin',
            'is_faq'  => true,
            'answered_by'      => 1
        ]);
        DB::table('questions')->insert([
            'question'      => '¿Cuáles son las ventajas para las empresas de los OGM?',
            'answer'     => 'Entre las ventajas para las empresas, resaltan las relacionadas con la
            producción agrícola, donde los OGM pueden implicar mayor resistencia a
            los agentes externos, alimentos básicos más nutritivos y mayor
            productividad de animales y cultivos, además de mejorar la resistencia y
            conservación de los productos en los procesos de traslado y
            almacenamiento. La biotecnología puede proporcionar una mayor
            productividad por metro cuadrado, disminución de plagas y enfermedades,
            y una reducción en la necesidad de aplicar sustancias agroquímicas (FAO,
            2003).',
            'asked_by'  => 'admin',
            'is_faq'  => true,
            'answered_by'      => 1
        ]);
        DB::table('questions')->insert([
            'question'      => '¿Cuáles son los riesgos de los OGM para las personas?',
            'answer'     => 'Se proponen potenciales efectos negativos del uso de OGM para las
            personas: la posibilidad de toxicidad para la salud; las posibilidad de
            provocar reacciones alérgicas; la posibilidad de que los genes insertados
            sean inestables, con el riesgo de transferencia genética; consecuencias
            nutricionales asociados con la modificación genética, donde la
            contaminación de organismos no modificados pueda alterar su seguridad
            y potencial nutritivo; otros posibles efectos (OEI, s.f.).
            Existen implicaciones sobre el respeto a la libertad de los consumidores
            son violados con el inadecuado etiquetado de OGM, impidiendo al público
            conocer el contenido de sus alimentos y decidir si desean o no ingerirlos
            (Group, 2016). La modificación genética de virus y otros organismos con
            alta capacidad de mutación y combinación, pueden implicar la aparición de
            nuevas enfermedades (AgroParlamento, 2001).
            También es posible contemplar riesgos económicos para las personas y
            comunidades, pues los derechos de propiedad intelectual sobre alimentos
            GM y patentes, tienen impacto sobre los derechos de los agricultores
            (OEI, s.f.). La acción extrema en la búsqueda del control de los mercados y
            la protección de sus inversiones, ha hecho que algunas empresas,
            desarrollen semillas que no pudieran ser reutilizadas o fértiles, (recibiendo
            el nombre de terminator) que generan dependencia de los campesinos
            con las transnacionales y así con diversos productos (Massieu, Chauvet,
            Castañeda, Barajas y González, 2000).',
            'asked_by'  => 'admin',
            'is_faq'  => true,
            'answered_by'      => 1
        ]);
        DB::table('questions')->insert([
            'question'      => '¿Cuáles son los riesgos de los OGM para las empresas?',
            'answer'     => 'La OEI (s.f.), señala que para las empresas puede haber consecuencias
            negativas económicas y de relaciones públicas asociadas al uso de OGM.
            Por lo general, la comercialización de OGM es objeto de extensiva 
            legislación y normas que generan ciertas limitaciones. Igualmente en el
            caso de los alimentos, existe un valor social/cultural e histórico además
            del nutricional, incluso connotaciones religiosas, por lo que la modificación
            tecnológica de los productos puede provocar respuestas negativas entre
            los consumidores.
            Se ha registrado una tendencia al control del mercado por parte de unas
            pocas grandes empresas, una creciente homogenización de cultivos, y
            control de la tecnología por grupos reducidos de capitales, lo que genera
            monopolios y afecta a los PyMEs. En los últimos años han aumentado las
            fusiones entre empresas agrobiotecnológicas y semilleras (Massieu,
            Chauvet, Castañeda, Barajas y González, 2000).',
            'asked_by'  => 'admin',
            'is_faq'  => true,
            'answered_by'      => 1
        ]);
        DB::table('questions')->insert([
            'question'      => '¿Cuál es el impacto de los OGM en el medio ambiente?',
            'answer'     => 'La manipulación de organismos vivos para modificar sus características
            genéticas es una práctica antigua. Los seres humanos han modificado
            organismos vivos desde hace aproximadamente 10.000 años. Sin embargo
            los cambios generados a través de cruces o exposición a mutágenos son
            imprecisas. Entre los beneficios del uso de OGM, se espera que, con el
            uso de la biotecnología moderna, aumente la precisión de las
            modificaciones a animales y cultivos, los cuales son sometidos a mayor
            grado de pruebas y regulaciones que los productos regulares, aumentando
            su nivel de seguridad (AgroBio, 2017).
            La FAO (2003) menciona la posible rehabilitación de tierras degradadas o
            menos fértiles, la disminución en el uso de agroquímicos y la creación de
            Biocombustibles a partir de materia orgánica. AgroBio (2017), incluye
            además la posibilidad de aumentar la agricultura sin labranza, la protección
            de insectos beneficiosos y una reducción de las emisiones de dióxido de
            carbono.
            Al mismo tiempo, entre los riesgos ambientales del uso de OGM, resalta
            de manera principal la disminución de la biodiversidad, la tendencia
            hacia el monocultivo de variedades puede profundizar la homogeneización
            cultivos, generando una suerte de erosión genética (Massieu, Chauvet,
            Castañeda, Barajas y González, 2000).
            Está demostrada la capacidad de los OGM para dispersarse e introducir
            genes de ingeniería genética en poblaciones silvestres; la posible
            persistencia del gen una vez que el OGM ha sido cosechado y la
            susceptibilidad de los organismos no objetivo como los insectos, bacterias
            y otros, pudiendo incluso desarrollar organismos resistentes; un mayor
            uso de sustancias químicas en la agricultura; la tendencia a un menor uso
            de la rotación de cultivos; el desplazamiento de genes de resistencia a los
            herbicidas y otros vegetales (OEI, s.f.).',
            'asked_by'  => 'admin',
            'is_faq'  => true,
            'answered_by'      => 1
        ]);
        DB::table('questions')->insert([
            'question'      => '¿Cuál es el impacto de los OGM en la economía de un país??',
            'answer'     => 'Dependiendo de la organización económica de cada país el uso de OGM
            puede tener impactos positivos o negativos. El uso de OGM es un factor
            potenciador del desarrollo científico y tecnológico en los países. En
            cuanto a la productividad agrícola, se ha registrado en varios casos un
            crecimiento de productividad nacional importante con la incorporación de
            biotecnología (Bragachini y Manfredi, 2011).
            Sin embargo, dependiendo del rol del Estado en éstas prácticas, los
            desarrollos biotecnológicos tienden a beneficiar más al sector privado y
            de exportaciones, que a cubrir las necesidades internas alimentarias de la
            población en los países que los producen. Al mismo tiempo, la
            biotecnología genera asimetría en las relaciones económicas entre los
            países, acentuando las brechas entre países industrializados y países en
            desarrollo, y entre los grandes capitales y las pequeñas empresas dentro
            de un país (Bota, 2003).',
            'asked_by'  => 'admin',
            'is_faq'  => true,
            'answered_by'      => 1
        ]);
        DB::table('questions')->insert([
            'question'      => '¿Qué es la bioética?',
            'answer'     => 'La bioética es la disciplina que estudia los aspectos éticos implicados en
            las ciencias de la vida, que incluyen en primer lugar la medicina y la
            biología, y en segundo lugar las humanidades, abarcando relaciones del
            hombre con los demás seres vivos y con la salud (PAHO, 2018). La
            bioética tiene el papel de clarificar las discusiones y debates complejos
            sobre las consecuencias éticas, sociales, económicas, políticas y
            jurídicas, etc que se derivan de avances tecnológicos (Rodríguez, 2010).',
            'asked_by'  => 'admin',
            'is_faq'  => true,
            'answered_by'      => 1
        ]);
        DB::table('questions')->insert([
            'question'      => '¿Qué es la bioseguridad?',
            'answer'     => 'La bioseguridad es un conjunto de medidas, protocolos y normas, que
            aplican en los procedimientos realizados en investigaciones científicas para
            la prevención de riesgos (biológico, químico, físico) o infecciones,
            controlando el manejo, uso, almacenamiento y barreras protectoras
            necesarias para garantizar la seguridad (UDD, s.f.), es decir, es un
            sistema de normas de acciones de seguridad que orientan y regulan las
            prácticas en salud (Rosas y Arteaga, 2003).',
            'asked_by'  => 'admin',
            'is_faq'  => true,
            'answered_by'      => 1
        ]);
        DB::table('questions')->insert([
            'question'      => '¿Existe una ley de bioseguridad en Venezuela?',
            'answer'     => 'Venezuela, Panamá y la UNAM de México han elaborado códigos de
            Bioseguridad y Bioética, introduciendo la regulación ética en las
            problemáticas de bioseguridad y no circunscribiendo las respuestas sólo a
            instancias técnicas (Bota, 2003).
            Igualmente, múltiples documentos, reglamentos y leyes en el país abordan
            el tema de la protección al ambiente, la salud y la sociedad, en cuanto a los
            riesgos de los OGM. Resalta la Constitución de la República Bolivariana
            de Venezuela, del año 1999, que alude al tema en sus artículos 11, 110,
            127, 129 y 328. Además, documentos con la Ley Orgánica de Ambiente, la
            Ley Orgánica de Seguridad de la Nación (artículos 11, 13 y 14), la Ley 
            Orgánica de Seguridad y Soberanía Alimentaria (art 12, 17 y 85), la Ley de
            Gestión de la Diversidad Biológica, a ley de Salud Agrícola Integral (artículo
            46), la Ley de Semillas, la Ley sobre Defensas Sanitarias Vegetal y Animal,
            la Ley de Protección de Fauna Silvestre, el Plan de la Patria, publicado en
            Gaceta Oficial 6118 del 2013, Ley Orgánica de Ciencia, Tecnología e
            Innovación y en la Ley de Bosques.',
            'asked_by'  => 'admin',
            'is_faq'  => true,
            'answered_by'      => 1
        ]);
        DB::table('questions')->insert([
            'question'      => '¿Cuáles son las instituciones responsables de regular los OGM en Venezuela?',
            'answer'     => 'Entre los organismos responsables de regular las actividades relacionadas
            con OGMs en Venezuela, se encuentra los Ministerios con competencia en
            la materia, como el MINEC – Ministerio del Poder Popular para el
            Ecosocialismo, MPPS - Ministerio del Poder Popular para la Salud,
            MPPAPT - Ministerio del Poder Popular para la Agricultura Productiva y
            Tierras, MPPEUCT - Ministerio del Poder Popular para Educación
            Universitaria Ciencia, Tecnología, MINPPIBES - Ministerio del Poder
            Popular de Industrias y Producción Nacional, MPPIC - Ministerio del Poder
            Popular para Industria y Comercio, MPPPA - Ministerio del Poder Popular
            de Pesca y Acuicultura, MPPD - Ministro del Poder Popular para la
            Defensa, MPPEF - Ministerio del Poder Popular de Economía y Finanzas
            Igualmente tienen competencia entes adscritos, incluyendo el INSAI -
            Instituto Nacional de Salud Agrícola Integral, SENCAMER - Servicio
            Autónomo Nacional de Normalización, Calidad, Metrología y Reglamentos
            Técnicos, SENIAT – Servicio Nacional Integrado de Administración
            Aduanera y Tributaria, y FANB – Fuerza Armada Nacional Bolivariana.',
            'asked_by'  => 'admin',
            'is_faq'  => true,
            'answered_by'      => 1
        ]);
        DB::table('questions')->insert([
            'question'      => '¿Por qué es importante el desarrollo de leyes y normas de bioseguridad en Venezuela?',
            'answer'     => 'Existen múltiples códigos en Venezuela que abordan el tema de los OGM,
            sin embargo no existe un documento que agrupe y legisle de forma general
            sobre la materia, con sus respectivos reglamentos específicos. Es
            importante una unificación de criterios y mantener la normativa
            actualizada en un campo tecnológico que evoluciona de forma rápida.
            Los desarrollos tecnológicos suelen ser de naturaleza neutra (salvo
            aquellos creados con el exclusivo propósito de dañar, como las armas), y
            su alcance depende de quiénes ostentan la propiedad sobre la tecnología y
            para qué fines la utilizan. Así, la regulación del Estado sobre los OGM,
            permite controlar que su uso sea, de forma exclusiva, para el beneficio de
            la población y no para su detrimento. Sólo el desarrollo de leyes y normas
            permite controlar qué productos entran al territorio, y sus adecuados
            manejos para evitar los riesgos potenciales a la salud, el ambiente y la
            economía que se deriven de su uso, previendo que no acarreen
            consecuencias negativas para la población.',
            'asked_by'  => 'admin',
            'is_faq'  => true,
            'answered_by'      => 1
        ]);
        DB::table('questions')->insert([
            'question'      => '¿Por qué es importante el desarrollo de leyes y normas de bioseguridad en Venezuela?',
            'answer'     => 'Existen múltiples códigos en Venezuela que abordan el tema de los OGM,
            sin embargo no existe un documento que agrupe y legisle de forma general
            sobre la materia, con sus respectivos reglamentos específicos. Es
            importante una unificación de criterios y mantener la normativa
            actualizada en un campo tecnológico que evoluciona de forma rápida.
            Los desarrollos tecnológicos suelen ser de naturaleza neutra (salvo
            aquellos creados con el exclusivo propósito de dañar, como las armas), y
            su alcance depende de quiénes ostentan la propiedad sobre la tecnología y
            para qué fines la utilizan. Así, la regulación del Estado sobre los OGM,
            permite controlar que su uso sea, de forma exclusiva, para el beneficio de
            la población y no para su detrimento. Sólo el desarrollo de leyes y normas
            permite controlar qué productos entran al territorio, y sus adecuados
            manejos para evitar los riesgos potenciales a la salud, el ambiente y la
            economía que se deriven de su uso, previendo que no acarreen
            consecuencias negativas para la población.',
            'asked_by'  => 'admin',
            'is_faq'  => true,
            'answered_by'      => 1
        ]);
        DB::table('questions')->insert([
            'question'      => '¿Cuál es el rol de las personas y las comunidades en el tema de los OGM?',
            'answer'     => 'Las personas y las comunidades son los principales afectados por el uso
            de OGM, ya sea que sus consecuencias sean positivas o negativas. Por lo
            tanto la población tiene derecho a estar informada y tomar decisiones
            sobre cómo se aplicará dicha tecnología en su país. Venezuela, partiendo
            del principio de la democracia participativa, integra a las comunidades en
            los procesos de toma de decisiones a nivel estadal, no sólo en la consulta
            por el voto, sino desde las discusiones iniciales para la redacción de los
            documentos normativos. Las personas y comunidades tienen la potestad
            de proponer leyes y normas, o modificaciones a las existentes, en base a
            sus saberes y experiencias sobre el tema, y el alcance de su participación
            puede ser comunal, municipal y nacional (Araque, 2014).',
            'asked_by'  => 'admin',
            'is_faq'  => true,
            'answered_by'      => 1
        ]);
        DB::table('questions')->insert([
            'question'      => '¿Cómo pueden las personas participar en los procesos y discusión sobre OGM?',
            'answer'     => 'La Constitución de la República Bolivariana de Venezuela de 1999
            expresa sobre la participación ciudadana que (artículo 62):
            “Todos los ciudadanos y ciudadanas tienen el derecho de participar
            libremente en los asuntos públicos, directamente o por medio de sus
            representantes elegidos o elegidas. La participación del pueblo en la
            formación, ejecución y control de la gestión pública es el medio necesario
            para lograr el protagonismo que garantice su completo desarrollo, tanto
            individual como colectivo. Es obligación del Estado y deber de la sociedad
            facilitar la generación de las condiciones más favorables para su práctica”.
            Las comunidades organizadas en Venezuela cuentan con múltiples
            mecanismos de participación en la actividad política del país y son
            convocadas de forma regular en los procesos legislativos para la discusión
            y el planteamiento de propuestas. En materia de OGM, el estado convoca
            a los miembros de las comunidades organizadas a participar libremente en
            las discusiones, y además brinda acceso a través del sitio web
            www.______.com a un sistema de Q&A (Preguntas y Respuestas) para
            permitir una comunicación más directa con las instituciones, además de
            sus canales regulares habituales.
            En el artículo 70 la constitución establece que “Son medios de
            participación y protagonismo del pueblo en ejercicio de su soberanía, en
            lo político: la elección de cargos públicos, el referendo, la consulta popular,
            la revocación del mandato, las iniciativas legislativa, constitucional y
            constituyente, el cabildo abierto y la asamblea de ciudadanos y ciudadanas
            cuyas decisiones serán de carácter vinculante, entre otros; y en lo social y
            económico: las instancias de atención ciudadana, la autogestión, la
            cogestión, las cooperativas en todas sus formas incluyendo las de carácter
            financiero, las cajas de ahorro, la empresa comunitaria y demás formas
            asociativas guiadas por los valores de la mutua cooperación y la 
            solidaridad. La ley establecerá las condiciones para el efectivo
            funcionamiento de los medios de participación previstos en este artículo”.
            Entre los múltiples mecanismos mencionados de los que dispone la
            población venezolana resalta la figura del Referendo, donde los pueblos
            tienen, con periodicidad, sus puntos de vista acerca de un determinado
            asunto, a quienes han sido elegidos para tomar decisiones. Esto incluye el
            Referendo consultivo, revocatorio, abrogatorio o aprobatorio (Araque,
            2014).',
            'asked_by'  => 'admin',
            'is_faq'  => true,
            'answered_by'      => 1
        ]);
        DB::table('questions')->insert([
            'question'      => '¿Cuáles son las instituciones responsables de regular los OGM en el mundo?',
            'answer'     => 'Diversos entes internacionales organizan, colaboran y median en las
            iniciativas de los países para regular el uso de OGM, si bien ellos no
            legislan de manera directa. Instituciones como las Naciones Unidas, la
            Organización Mundial de la Salud (OMS), la FAO (Food and Agriculture
            Organization de las Naciones Unidas), el PNUMA o Programa de las
            Naciones Unidas para el Medio Ambiente, la Organización Mundial del
            Comercio (OMC), el PNUD (Programa de las Naciones Unidas para el
            Desarrollo), el Centro de Intercambio de Información sobre Seguridad de la
            Biotecnología (CIISB), el GEF (Global Environment Facility, mejor
            conocido como el Fondo para el Medio Ambiente Mundial), Organización
            para el Desarrollo y Cooperación Económica (OCDE), el Centro Mundial de
            Vigilancia de la Conservación o UNEP-WCMC, entre otras, han sido
            responsables de la discusión y elaboración de documentos,
            convenciones y protocolos que, al ser suscritos por las naciones
            participantes, adquieren carácter vinculante en sus respectivas normas
            internas.',
            'asked_by'  => 'admin',
            'is_faq'  => true,
            'answered_by'      => 1
        ]);
        DB::table('questions')->insert([
            'question'      => '¿Cuáles son los acuerdos internacionales más importantes en materia de bioseguridad?',
            'answer'     => 'Luego de largas discusiones y negociaciones entre múltiples países se han
            elaborado importantes documentos internacionales en materia de
            bioseguridad donde resalta la Convención para la Diversidad Biológica
            (CBD), nacida a partir de la Cumbre de Río de Janeiro de 1992, de la que
            derivó el Protocolo de Cartagena sobre Seguridad de la Biotecnología
            del Convenio sobre la Diversidad Biológica, que entró en vigor en el año
            2003.
            Venezuela es uno de los 170 países que suscribe éste acuerdo y en base
            a sus directrices establece la planificación en materia de bioseguridad en el
            país. El Protocolo de Cartagena establece la conservación de la
            diversidad biológica, a través de la adecuada gestión de los riesgos
            asociados con los organismos vivos modificados (OGM) resultante del uso
            de la biotecnología moderna; se enfoca principalmente en los
            movimientos transfronterizos de los OGMs y busca establecer normas y 
            procedimientos que permitan la manipulación, uso y transferencia segura
            (Secretaría del Convenio sobre la Diversidad Biológica, 2000).
            Otros documentos importantes que se relacionan con el tema incluyen la
            Convención para la Prohibición de las Armas Biológicas (CABT)
            vigente desde 1975, que prohíbe el desarrollo, producción, adquisición,
            transferencia, retención, intercambio y almacenamiento de armas tóxicas y
            biológicas. La Convención de Aarhus, que vela por el respeto al derecho
            de las personas a la información, acceso a la justicia, participación pública
            y el proceso de toma de decisiones en materia ambiental, firmado en 1998
            (MAPAMA, s.f.); y la Convención Internacional de Protección
            Fitosanitaria (CIPF) para prevenir la diseminación e introducción de plagas
            de plantas y productos vegetales, así como promover medidas apropiadas
            para combatirlas, con el fin de la conservación de la biodiversidad vegetal y
            en la protección de los recursos naturales (FAO, 2004).',
            'asked_by'  => 'admin',
            'is_faq'  => true,
            'answered_by'      => 1
        ]);
    }
}
