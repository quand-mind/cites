<template>
    <div>
        <draggable v-model="pagesList">
            <transition-group type="transition" name="flip-list">
                <div v-for="element in pagesList" :key="element.id">
                    b-
                    <span>{{element.title}}</span>
                    <span>{{element.id}}</span>
                </div>
            </transition-group>
        </draggable>
    </div>
</template>

<script>
import draggable from 'vuedraggable'
export default {
    props: ['pages'],
    data: () => ({
        pagesList: []
    }),
    components: {
        draggable
    },
    mounted () {
        console.log(this.pages)
        this.pagesList = [...this.pages]
    }
}
</script>