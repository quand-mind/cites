<template>
    <div>
        <titulo :msg="page.title" />
        <div v-html="page.content"></div>
        <!-- Escrito Leyes-->
        <div class="d-flex flex-column p-5 mx-5 text-justify">

            <p v-if="filesData.length === 0">No hay leyes en esta sección</p>

            <b-card v-for="file in filesData" :key="file.name" :title="file.name">
                <b-card-text v-html="file.description">
                {{file.description}}
                </b-card-text>

                <a :href="'/storage' + file.path" target="_blank" class="url card-link">Descargar aquí</a>
            </b-card>
        </div>
    </div>
</template>
<script>
import titulo from "../components/Titulo.vue"

export default {
    props: ['filesData', 'page'],
    components: {
        titulo
    },
    data: () => ({

    })
}
</script>

<style lang="scss">
.law-item {
  display: flex;
  justify-content: space-between;
  padding: 1rem 2rem;

  border-bottom: 1px solid #ddd;
}
</style>