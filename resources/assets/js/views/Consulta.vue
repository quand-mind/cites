<template>
    <div>
        <div class="content">{{ page.content }}</div>
        <newQuestion></newQuestion>
    </div>
</template>
<script>
import newQuestion from '../components/Hacer-pregunta'

export default {
    components: {
        newQuestion
    },
    props: ['page']
}
</script>