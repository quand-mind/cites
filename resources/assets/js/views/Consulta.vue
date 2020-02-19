<template>
    <div>
<<<<<<< HEAD
        <div class="content mb-5">{{ page.content }}</div>
=======
        <div class="content">{{ page.content }}</div>
>>>>>>> master
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
<<<<<<< HEAD
</script>

<style lang="scss" scoped>
	.content{
	}
</style>
=======
</script>
>>>>>>> master
