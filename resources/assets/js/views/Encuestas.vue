<!--
Ultima Actualización: 03/02/2020

Tipo de componente: Vista

Ruta:/encuesta

Descripción:
	Encuestas

 -->
<template>
    <div>
        <titulo msg="Encuestas" />
        <div v-if="surveys.length > 0" class="mt-5">
            <b-button
            v-for="survey in surveys"
            :key="survey.id + survey.title"
            :href="survey.url"
            target="_blank"
            block
            variant="info"
            class="text-uppercase ml-4 btn font-weight-bold btn-lg my-3"
            >{{survey.title}}</b-button>
        </div>
        <div v-else class="mt-5">No hay encuestas disponibles</div>
    </div>
</template>
<script>

import titulo from "../components/Titulo.vue";
import axios from "axios";
import pregunta from "../components/Hacer-pregunta.vue";

export default {
      components: {
        titulo,
        pregunta
    },
    data(){
        return{
            surveys: []
        }
    },
    created(){
        let _this = this;
        axios
        .get("/surveys-list")
        .then(res => {
        _this.surveys = [...res.data];
        })
        .catch(err => console.log(err.response));
    }
}
</script>
<style>
    .noticia:hover {
        background-color: #b9b9b9;
    }
</style>