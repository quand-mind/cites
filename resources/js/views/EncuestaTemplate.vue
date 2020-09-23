<!-- 
Ultima Actualización: 31/01/2020

Tipo de componente: Vista

Ruta:/como-participar/encuesta/{any}/

Descripción:
  Renderiza con iframe la encuesta 
 -->

<template>
  <div>

    <!-- <titulo :msg="page.title"/> -->
    <titulo msg="Encuesta # 1"/>

    <p>{{survey.description}}</p>
<!-- Escrito -->
    <iframe :src="survey.url"></iframe>
  
    </div>
</template>

<script>
  import titulo from "../components/Titulo.vue"

  export default{
    components:{
      titulo,
    },
    props: [
     'survey'
    ]
  }
</script>


<style scoped>
  p{
    margin: 30px 0px;
  }
  iframe{
    width: 100%;
    height: 100vh;
    margin: 10px;
    border: 0;
  }

</style>