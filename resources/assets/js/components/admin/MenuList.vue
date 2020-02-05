<template>
    <div>
        <div class="mb-5 ml-5">
            <h1 class="">Menú</h1>
            <h5 class="secondary">Arrastra y mueve las páginas para cambiar el orden</h5>
        </div>
        
        <draggable v-model="pagesList">
            <transition-group type="transition" name="flip-list">
                <div v-for="(menuItem, index) in pagesList" :key="menuItem.id" class="container">
                    <b-list-group>
                        <b-list-group-item button v-b-toggle.:aria-controls="menuItem.title" class="w-50">
                            <span>{{index}} - </span>
                            <span>{{menuItem.title}}</span>
                            <span v-if="menuItem.get_subpages.length > 0">Jaja</span>
                        </b-list-group-item>
                        <div v-if="menuItem.get_subpages.length > 0">
                            <draggable v-model="pagesList.getsubpages">
                                <transition-group type="transition" name="flip-list">
                                    <div v-for="submenuItem in menuItem.get_subpages" :key="submenuItem.id">
                                                <b-collapse :id="menuItem.title" >
                                                    <b-list-group-item button variant="secondary" class="w-50">
                                                        <span>{{submenuItem.title}}</span>
                                                    </b-list-group-item>
                                                </b-collapse>
                                    </div>
                                </transition-group>
                            </draggable>
                        </div>
                    </b-list-group>
                    
                        
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