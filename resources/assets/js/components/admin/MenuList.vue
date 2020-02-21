<template>
    <div>
        <div class="mb-5 ml-5">
            <h1 class="">Menú</h1>
            <h5 class="secondary">Arrastra y mueve las páginas para cambiar el orden</h5>
        </div>
        
        <draggable v-bind="dragOptions" v-model="pagesList" :move="handleMove">
            <transition-group type="transition" name="flip-list">
                <div v-for="menuItem in pagesList" :key="menuItem.id" class="container">
                    <b-list-group>
                        <b-list-group-item button v-b-toggle.:aria-controls="menuItem.title" class=" d-flex w-50 align-items-center">
                            <b-row class="w-100">
                                <b-col cols="1"><span>{{menuItem.menu_order}}</span></b-col>
                                <b-col cols="1"><span>-</span></b-col>
                                <b-col cols="9"><span>{{menuItem.title}}</span></b-col>
                                <b-col cols="1"><span v-if="menuItem.get_subpages.length > 0"><i class="fas fa-caret-down"></i></span></b-col>
                            </b-row>
                        </b-list-group-item>
                        <div v-if="menuItem.get_subpages.length > 0">
                            <draggable v-bind="dragOptionsSub" v-model="menuItem.get_subpages" :move="handleMoveSub">
                                <transition-group type="aaa" name="flip-list-sub">
                                    <div v-for="submenuItem in menuItem.get_subpages" :key="submenuItem.id">
                                                <b-collapse :id="menuItem.title" >
                                                    <b-list-group-item button variant="secondary" class="w-50">
                                                        <b-row class="w-100">
                                                            <b-col cols="1"></b-col>
                                                            <b-col cols="1"><span>{{submenuItem.menu_order}}</span></b-col>
                                                            <b-col cols="1"><span>-</span></b-col>
                                                            <b-col cols="9"><span>{{submenuItem.title}}</span></b-col>                                                            
                                                        </b-row>
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
        <b-row class="mt-5">
          <b-col class="ml-5">
            <b-button @click="saveMenu" class="submit-btn " size="lg" type="submit" variant="primary">Guardar</b-button>
          </b-col>
        </b-row>
    </div>
</template>

<script>
import draggable from 'vuedraggable'
import axios from 'axios'

export default {
    props: ['pages'],
    data: () => ({
        pagesList: []
    }),
    components: {
        draggable
    },
    methods: {
        handleDrop (e, a) {
            console.log(e, a)
        },
        handleMove(e,a) {
            var aux = 0
            aux = this.pagesList[e.draggedContext.index].menu_order
            this.pagesList[e.draggedContext.index].menu_order = this.pagesList[e.relatedContext.index].menu_order
            this.pagesList[e.relatedContext.index].menu_order = aux
        },
        handleMoveSub (e,a) {
            var item
            var y
            var id = e.draggedContext.element.main_page
            var order
            for(item of this.pagesList){
                if(item.id === id){
                    order = item.menu_order - 1
                    break
                }
            }
            y = this.pagesList[order].get_subpages[e.draggedContext.index].menu_order
            this.pagesList[order].get_subpages[e.draggedContext.index].menu_order = this.pagesList[order].get_subpages[e.relatedContext.index].menu_order
            this.pagesList[order].get_subpages[e.relatedContext.index].menu_order = y
        },
        saveMenu () {
            let _this = this

            axios
                .post('/dashboard/menu/updateOrder', _this.pagesList)
                .then(res => _this.makeToast(res.data))
                .catch(err => {
                    let { data } = err.response

                    if (data.errors !== undefined || data.errors !== null) {
                        let errors = Object.values(data.errors).toString()
                        _this.makeToast(errors, "danger");
                    } else {
                        _this.makeToast(data, "danger");
                    }
                })
        },
        makeToast(msg, variant = "success", delay = 3000, append = false) {
            this.$bvToast.toast(`${msg}`, {
                title: "Evento de actualización del menú",
                autoHideDelay: delay,
                appendToast: append,
                variant
            });
        },
    },
    mounted () {        
        this.pagesList = this.pages.map((page, mainIdx) => {
            if (!page.menu_order) page.menu_order = mainIdx + 1

            if (page.get_subpages.length > 0) {
                page.get_subpages = page.get_subpages.map((subpage,index)=>{
                    if (!subpage.menu_order) subpage.menu_order = index + 1
                    return subpage
                })

                page.get_subpages.sort((link1, link2) => link1.menu_order - link2.menu_order)
            }

            return page
        })
    },
    computed: {
        dragOptions() {
            return {
                animation: 200,
                group: "main",
                disabled: false,
                ghostClass: "ghost"
            };
        },
        dragOptionsSub() {
            return {
                animation: 200,
                disabled: false,
                ghostClass: "ghost"
            };
        } 
  }
}
</script>