<template>
    <div>
        <div class="mb-5 ml-5">
            <h1 class="">Menú</h1>
        </div>

        <b-container>
            <b-row>
                <b-col>
                    <h5 class="secondary">Arrastra y mueve las páginas para cambiar el orden</h5>
                    <draggable v-bind="dragOptions" v-model="pagesList" :move="handleMove">
                        <transition-group type="transition" name="flip-list">
                            <div v-for="(menuItem, index) in pagesList" :key="menuItem.id" class="container menu-list">
                                <b-row
                                    button
                                    v-b-toggle.:aria-controls="menuItem.title"
                                    class="w-100 list-group-item"
                                >
                                    <b-col cols="1"><span>{{menuItem.menu_order}}</span></b-col>
                                    <b-col cols="1"><span>-</span></b-col>
                                    <b-col cols="9"><span>{{menuItem.title}}</span></b-col>
                                    <b-col cols="1">
                                        <a v-if="menuItem.get_subpages.length > 0">
                                            <b-button
                                                variant="outline-secondary"
                                                size="sm"
                                                :id="`tooltip-target-${menuItem.id}`"
                                                @click="editSubpages(index)"
                                            >
                                                <font-awesome-icon :icon="['fas', 'list-ul']"></font-awesome-icon>
                                            </b-button>
                                            <b-tooltip :target="`tooltip-target-${menuItem.id}`" triggers="hover">
                                                Click para editar las subpáginas de este link
                                            </b-tooltip>
                                        </a>
                                    </b-col>
                                </b-row>
                            </div>
                        </transition-group>
                    </draggable>
                </b-col>
                <b-col>
                    <h5>Selecciona qué páginas quieres ver en el menú principal</h5>
                    <b-list-group class="pages-scroll-list">
                        <b-list-group-item
                            v-for="page in allPages"
                            :key="page.id + '--list'"
                        >
                            <b-form-checkbox
                                :id="'checkbox-' + page.id"
                                v-model="page.is_onMenu"
                                :name="page.title + 'checkbox'"
                                @change="toggleIsOnMenu(page)"
                            >{{ page.title }}</b-form-checkbox>                                
                        </b-list-group-item>
                    </b-list-group>
                </b-col>
            </b-row>
        </b-container>

        <b-modal
            ref="edit-subpages-modal"
            @hidden="resetIndex"
        >
            <draggable v-if="mainPageSelected" v-bind="dragOptionsSub" v-model="mainPageSelected.get_subpages" :move="handleMoveSub">
                <transition-group type="transition" name="flip-list">
                    <div v-for="menuItem in mainPageSelected.get_subpages" :key="menuItem.id" class="container menu-list">
                        <b-row
                            button
                            v-b-toggle.:aria-controls="menuItem.title"
                            class="w-100 list-group-item"
                        >
                            <b-col cols="1"><span>{{menuItem.menu_order}}</span></b-col>
                            <b-col cols="1"><span>-</span></b-col>
                            <b-col cols="10"><span>{{menuItem.title}}</span></b-col>
                        </b-row>
                    </div>
                </transition-group>
            </draggable>
        </b-modal>
    </div>
</template>

<script>
import draggable from 'vuedraggable'
import axios from 'axios'
export default {
    props: ['pages'],
    data: () => ({
        pagesList: [],
        allPages: [],
        indexPageToEditSubpages: null,
        mainPageSelected: null
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

            this.saveMenu()
        },
        handleMoveSub (e,a) {
            let aux = 0
            let mainPage = this.pagesList[this.indexPageToEditSubpages]
            aux = mainPage.get_subpages[e.draggedContext.index].menu_order
            mainPage.get_subpages[e.draggedContext.index].menu_order = mainPage.get_subpages[e.relatedContext.index].menu_order
            mainPage.get_subpages[e.relatedContext.index].menu_order = aux

            this.saveMenu()
        },
        resetIndex () {
            this.indexPageToEditSubpages = null
            this.mainPageSelected = null
        },
        editSubpages(index) {
            this.indexPageToEditSubpages = index
            this.mainPageSelected = this.pagesList[index]
            this.$refs['edit-subpages-modal'].show()
        },
        toggleIsOnMenu (page) {
            page.is_onMenu = !page.is_onMenu
            let _this = this
   
            axios
                .post(`/dashboard/pages/toggleIsOnMenu/${page.id}`,
                    {
                        is_onMenu: Number(page.is_onMenu)
                    }
                )
                .then(res => {
                    _this.makeToast(res.data.msg)
                    _this.formatPages(res.data.pages)
                    _this.filterPagesOnMenu(_this.allPages)
                })
                .catch(err => {
                    console.log(err)
                    _this.makeToast(err.response.message, 'danger')
                })
        },
        saveMenu () {
            let _this = this
            axios
                .post('/dashboard/menu/updateOrder', _this.pagesList)
                .then(res => _this.makeToast(res.data))
                .catch(err => _this.makeToast(err.response.message, 'danger'))
        },
        makeToast(msg, variant = "success", delay = 3000, append = false) {
            this.$bvToast.toast(`${msg}`, {
                title: "Evento de actualización del menú",
                autoHideDelay: delay,
                appendToast: append,
                variant
            });
        },
        filterPagesOnMenu (pages) {
            this.pagesList = pages.filter(page => page.is_onMenu)
        },
        formatPages (pages) {
            this.allPages = pages.map((page, mainIdx) => {
                if (!page.menu_order) page.menu_order = mainIdx + 1
                if (page.get_subpages.length > 0) {
                    page.get_subpages = page.get_subpages.map((subpage,index)=>{
                        if (!subpage.menu_order) subpage.menu_order = index + 1
                        return subpage
                    })
                    page.get_subpages.sort((link1, link2) => link1.menu_order - link2.menu_order)
                }

                page.is_onMenu = Boolean(page.is_onMenu)
                return page
            })
        }
    },
    mounted () {        
        this.formatPages(this.pages)
        this.filterPagesOnMenu(this.allPages)
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

<style lang="scss">
    .menu-list {
        max-width: 600px;

        .row {
            color: #383d41;
            display: flex;
        }
    }

    .pages-scroll-list {
        max-height: 100%;
        overflow: auto;
    }
</style>