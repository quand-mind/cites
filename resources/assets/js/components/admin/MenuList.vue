<template>
    <div>
        <draggable v-model="pagesList">
            <transition-group type="transition" name="flip-list">
                <div v-for="menuItem in pagesList" :key="menuItem.id">
                    <b-button v-b-toggle.:aria-controls="menuItem.title" variant="primary">
                        <span>{{menuItem.title}}</span>
                    </b-button>
                    <div v-if="menuItem.get_subpages.length > 0">
                        <draggable v-model="pagesList.getsubpages">
                            <transition-group type="transition" name="flip-list">
                                <div v-for="submenuItem in menuItem.get_subpages" :key="submenuItem.id">
                                    <b-collapse :id="menuItem.title" class="mt-2">
                                        <b-card>
                                            <span>{{submenuItem.title}}</span>
                                        </b-card>
                                    </b-collapse>
                                </div>
                            </transition-group>
                        </draggable>
                    </div>
                        
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
        this.pagesList = [...this.pages]
        
    }
}
</script>