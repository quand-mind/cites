<template>
    <div>
        <pre>{{pagesList}}</pre>
    </div>
</template>

<script>
export default {
    props: ['pages'],
    data: () => ({
        pagesList: []
    }),
    mounted () {
        console.log(this.pages)
        this.pagesList = [...this.pages]
    }
}
</script>