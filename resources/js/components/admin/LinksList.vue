<template>
    <div>
        <div class="mb-5 ml-5">
            <h1 class="">Menú</h1>
        </div>

        <b-container>
            <b-row>
                <b-col>
                    <h5 class="secondary">Arrastra y mueve los links para cambiar el orden</h5>
                    <draggable v-bind="dragOptions" v-model="linksList" :move="handleMove">
                        <transition-group type="transition" name="flip-list">
                            <div v-for="(link, index) in linksList" :key="link.id" class="container menu-list">
                                <b-row
                                    button
                                    v-b-toggle.:aria-controls="link.title"
                                    class="w-100 list-group-item"
                                >
                                    <b-col cols="1"><span>{{link.order}}</span></b-col>
                                    <b-col cols="1"><span>-</span></b-col>
                                    <b-col cols="9"><span>{{link.title}}</span></b-col>
                                    <b-col cols="1">
                                        <a v-if="link.get_subpages.length > 0">
                                            <b-button
                                                variant="outline-secondary"
                                                size="sm"
                                                :id="`tooltip-target-${link.id}`"
                                                @click="editSubpages(index)"
                                            >
                                                <font-awesome-icon :icon="['fas', 'list-ul']"></font-awesome-icon>
                                            </b-button>
                                            <b-tooltip :target="`tooltip-target-${link.id}`" triggers="hover">
                                                Click para editar las subpáginas de este link
                                            </b-tooltip>
                                        </a>
                                    </b-col>
                                </b-row>
                            </div>
                        </transition-group>
                    </draggable>
                </b-col>
            </b-row>
        </b-container>

        <b-modal
            ref="edit-subpages-modal"
            @hidden="resetIndex"
        >
        <!-- Edit link -->
        </b-modal>
    </div>
</template>

<script>
import draggable from 'vuedraggable'
import axios from 'axios'
export default {
    props: ['pages'],
    data: () => ({
        linksList: [],
        linkSelected: null
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
            aux = this.linksList[e.draggedContext.index].order
            this.linksList[e.draggedContext.index].order = this.linksList[e.relatedContext.index].order
            this.linksList[e.relatedContext.index].order = aux

            this.saveMenu()
        },
        resetIndex () {
            this.indexPageToEditSubpages = null
            this.linkSelected = null
        },
        editSubpages(index) {
            this.indexPageToEditSubpages = index
            this.linkSelected = this.linksList[index]
            this.$refs['edit-subpages-modal'].show()
        },
        toggleIsOnMenu (page) {
            page.is_onMenu = !page.is_onMenu
            let _this = this
   
            axios
                .post(`/dashboard/pages/toggleIsVisible/${page.id}`,
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
                .post('/dashboard/menu/updateOrder', _this.linksList)
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
            this.linksList = pages.filter(page => page.is_onMenu)
        },
        formatPages (pages) {
            this.allPages = pages.map((page, mainIdx) => {
                if (!page.order) page.order = mainIdx + 1
                if (page.get_subpages.length > 0) {
                    page.get_subpages = page.get_subpages.map((subpage,index)=>{
                        if (!subpage.order) subpage.order = index + 1
                        return subpage
                    })
                    page.get_subpages.sort((link1, link2) => link1.order - link2.order)
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