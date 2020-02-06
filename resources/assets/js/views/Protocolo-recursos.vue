<!-- 
Ultima Actualización: 16/01/2020

Tipo de componente: Vista

Ruta:/protocolo/recursos

Descripción:
	Muestra una galeria de imagenes y videos acerca de los OVM y los proyectos
 -->

<template>
	<div>
    <div class="menu">
    	<b-nav-item v-on:click="() => link.sublinks ? false : closeNav()" class="nav-item" v-for="(link, index) in links" :key="link.url + index">
	      <b-button v-b-toggle.collapse-1 variant="transparent" class="text-white" :to="link.url">{{link.name}}</b-button>
	      <!-- <router-link :to="link.url">{{link.name}}</router-link> -->

	    <b-nav class="sub-nav w-100" v-if="link.sublinks">
	        <b-nav-item v-on:click="closeNav" v-for="sublink in link.sublinks" :key="sublink.url">
	          <b-button to="/" variant="transparent"  class="text-white sub-link">hola!</b-button>
	        </b-nav-item>
      </b-nav>
    <!--   <b-nav class="sub-nav verde" v-if="link.sublinks">
        <b-nav-item v-on:click="closeNav" v-for="sublink in link.sublinks" :key="sublink.url">
          <router-link :to="sublink.url" class="text-white">{{sublink.name}}</router-link>
        </b-nav-item>
      </b-nav> -->
	    </b-nav-item>
	  <b-collapse id="collapse-1" class="w-100">
	  </b-collapse>
    </div>

		<titulo msg="Protocolo de cartagena"/>
		<h2 class="text-center my-5 font-weight-light">Imágenes</h2>
		<div class="d-flex flex-wrap px-5 justify-content-center align-items-center">
			<imagen/>
			<imagen/>
			<imagen/>
			<imagen/>
			<imagen/>
			<imagen/>
		</div>

		<h2 class="text-center my-5 font-weight-light">Videos</h2>
		<div class="d-flex flex-wrap px-5 justify-content-center align-items-center">
			<videos/>
			<videos/>
			<videos/>
			<videos/>
		</div>		
    </div>
</template>

<script>
	import titulo from "../components/Titulo.vue"
	import imagen from "../components/Imagen.vue"
	import videos from "../components/Video.vue"

	export default{
		components:{
			titulo,
			imagen,
			videos
		},

	data: () => ({
    links: [
      {
        name: "Proyecto",
        url: "#",
        sublinks: [
          {
            name: "Comisión Nacional de Bioética y Bioseguridad en Salud",
            url: "/proyecto/comision-nacional-de-bioseguridad"
          },
          {
            name: "Acuerdos Internacionales",
            url: "/proyecto/acuerdos-internacionales"
          },
          {
            name: "Legislación",
            url: "/proyecto/legislacion"
          },
          {
            name: "Antecedentes y Justificación",
            url: "/proyecto/antecedentes-y-justificacion"
          }
        ]
      },
      {
        name: "¿Qué es un transgénico?",
        url: "/transgenico"
      },
      {
        name: "¿Quiénes somos?",
        url: "#",
        sublinks: [
          {
            name: "Grupos",
            url: "/somos/grupos"
          },
          {
            name: "Objetivos",
            url: "/somos/objetivos"
          },
          {
            name: "Misión",
            url: "/somos/mision"
          },
          {
            name: "Visión",
            url: "/somos/vision"
          }
        ]
      },
      {
        name: "Preguntas frecuentes y encuestas",
        url: "#",
        sublinks: [
          {
            name: "Preguntas Frecuentes",
            url: "/preguntas-frecuentes"
          },
          {
            name: "Encuestas",
            url: "/encuestas"
          }
        ]      },
      {
        name: "Protocolo de Cartagena",
        url: "#",
        sublinks: [
          {
            name: "Mitos y Realidades",
            url: "/protocolo/mitos-realidades"
          },
          {
            name:
              "¿Qué hacer si entra otro tipo de OVM al territorio nacional?",
            url: "/protocolo/ovm-territorio-nacional"
          },
          {
            name: "FAQS sobre el protocolo",
            url: "/protocolo/preguntas-frecuentes"
          },
          {
            name: "Recursos",
            url: "/protocolo/recursos"
          }
        ]
      },
      {
        name: "Proyectos asociados",
        url: "#",
        sublinks: [
          {
            name: "Nagoya-Lumpur",
            url: "/asociados/nagoya-lumpur"
          }
        ]
      },
      {
        name: "Lab. Nacional de detección de OVM",
        url: "/laboratorio-nacional-ovm"
      },
      {
        name: "Recursos",
        url: "#",
        sublinks: [
          {
            name: "Información sobre OVM en Venezuela",
            url: "/recursos/ovm-venezuela"
          },
          {
            name: "Portales de la temática",
            url: "/recursos/portales"
          },
          {
            name: "Formularios de uso común",
            url: "/recursos/formularios"
          },
          {
            name: "Mapa del sitio",
            url: "/recursos/mapa-del-sitio"
          },
          {
            name: "Glosario",
            url: "/recursos/glosario"
          }
        ]
      }
    ]
  })
	}
</script>

<style lang="scss" scoped>
	.menu{
		display: flex;
  		flex-direction: column;
		width: 50vw;
		background-color: #2c3e50;
		transition: all ease 100ms;
}
	a{
		color: #fff !important
	}
	.sub-nav {
    transition: all 2s ease;
    flex-direction: column;
    background-color: #2c3e50;
     }
     .sub-link:hover{
     	background-color: #00a96d;
     }
</style>