<template>
    <div>
        <div class="content mb-5">{{ page.content }}</div>
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

<style lang="scss" scoped>
	.content{
	}
</style>
