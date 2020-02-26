<template>
    <div>
        <titulo :msg="page.title"/>
        <div class="content mb-2" v-html="page.content"></div>
        <newQuestion></newQuestion>
    </div>
</template>
<script>
import newQuestion from '../components/Hacer-pregunta.vue'
import titulo from "../components/Titulo.vue"

export default {
    components: {
        newQuestion,
        titulo
    },
    props: ['page']
}
</script>

<style lang="scss" scoped>
	.content{
	}
</style>
