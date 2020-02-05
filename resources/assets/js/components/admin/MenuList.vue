<template>
    <div>
        <draggable v-model="pagesList">
            <transition-group type="transition" name="flip-list">
                <div v-for="element in pagesList" :key="element.id">
                    <b-button v-b-toggle.collapse-1 variant="primary">
                        <span>{{element.title}}</span>
                    </b-button>
                    <b-collapse id="collapse-1" class="mt-2">
                        <b-card>
                            <span>{{element.id}}</span>
                        </b-card>
                    </b-collapse>
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