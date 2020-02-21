<template>
    <div>
        <titulo :msg="page.title" />
        <!-- Escrito Leyes-->
        <div class="d-flex flex-column p-5 mx-5 text-justify">
            <div class="law-item" v-for="file in filesData" :key="file.name">
                <div class="name">{{file.name}}</div>
                <a :href="file.path" target="_blank" class="url">Descargar aquí</a>
            </div>
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