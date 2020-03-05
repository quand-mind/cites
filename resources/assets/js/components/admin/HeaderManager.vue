<template>
    <div class="d-flex header-manager">
        <div class="mb-5 ml-5">
            <h1 class="">Cabecera</h1>
            <h5 class="secondary">Agrega una nueva imagen</h5>
            <vue-dropzone 
                class="dropzone"
                ref="dropzone"
                id="dropzone"
                v-on:vdropzone-complete="handleUploadedFiles"
                :options="dropzoneOptions"
            ></vue-dropzone>
        </div>

        <div class="mb-5 ml-5 w-100">
            <h5 class="secondary">Arrastra y mueve las páginas para cambiar el orden</h5>
            
            <draggable v-bind="dragOptions" v-model="imagesList" :move="handleMove">
                <transition-group class="d-flex flex-wrap" type="transition" name="flip-list">
                    <div v-for="image in imagesList" :key="image.id" class="header-img">
                        <img :src="'/storage/' + image.src" alt="header img">
                        <a href="javascript:;" @click="deleteImage(image.id)" class='text-danger delete-icon'>
                            <font-awesome-icon size="2x" :icon="['fas', 'times-circle']"></font-awesome-icon>
                        </a>
                    </div>
                </transition-group>
            </draggable>
            <b-row class="mt-5">
                <b-col>
                    <b-button @click="saveImages" class="submit-btn " size="lg" type="submit" variant="primary">Guardar</b-button>
                </b-col>
            </b-row>
        </div>
        
    </div>
</template>

<script>
import draggable from 'vuedraggable'
import axios from 'axios'
// Dropzone
import vue2Dropzone from 'vue2-dropzone'
import 'vue2-dropzone/dist/vue2Dropzone.min.css'

export default {
    props: ['images'],
    data: () => ({
        imagesList: [],
        dropzoneOptions: {
            url: '/dashboard/header-manager',
            paramName: 'images',
            uploadMultiple: true,
            maxFilesize: 4096,
            thumbnailWidth: 300,
            addRemoveLinks: true,
            dictDefaultMessage: "<i class='fa fa-cloud-upload'></i> CARGAR IMAGEN",
            acceptedFiles: 'image/*',
            headers: {
                'x-csrf-token': document.querySelector('meta[name="csrf-token"]').content
            }
        }
    }),
    components: {
        draggable,
        vueDropzone: vue2Dropzone
    },
    methods: {
        handleMove(e,a) {
            var aux = 0
            aux = this.imagesList[e.draggedContext.index].image_order
            this.imagesList[e.draggedContext.index].image_order = this.imagesList[e.relatedContext.index].image_order
            this.imagesList[e.relatedContext.index].image_order = aux
        },
        handleUploadedFiles (response) {
            let _this = this

            if(response.status === "success") {
                this.makeToast('Imagenes cargadas');
                _this.$refs.dropzone.removeAllFiles();
                _this.updateImages();
            } else {
                this.makeToast('Error al cargar las imágenes', "danger");
            }

        },
        deleteImage (id) {
            let _this = this;

            axios
                .delete(`/dashboard/header-manager/${id}`)
                .then(res => {
                    _this.makeToast(res.data)
                    _this.updateImages()
                })
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
        updateImages () {
            let _this = this

            axios
                .get('/header-images')
                .then(res => {
                    _this.imagesList = [...res.data];
                })
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
        saveImages () {
            let _this = this

            axios
                .post('/dashboard/header-manager/update', _this.imagesList)
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
                title: "Evento de actualización de la cabecera",
                autoHideDelay: delay,
                appendToast: append,
                variant
            });
        },
    },
    mounted () {        
        this.imagesList = this.images.map((page, mainIdx) => {
            if (!page.image_order) page.image_order = mainIdx + 1;
            return page;
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

<style lang="scss">
    @import url("https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css");
    .dropzone {
        width: 400px;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .header-img {
        width: 300px;
        border: solid 2px #343a40;
        border-radius: 5px;
        margin: 10px 20px;
        display: flex;
        align-items: center;
        position: relative;

        .delete-icon {
            top: 10px;
            right: 10px;
            opacity: 0;
            transition: all .5s ease;
            position: absolute;
            z-index: 4;
        }

        img {
            width: 100%;

            // &:hover ~ .icon {
            //     opacity: 1;
            //     transition: all .5s ease;
            // }
        }

        &:hover {
            .delete-icon {
                opacity: 1;
                transition: all .5s ease;
            }
        }
    }

    .header-manager > div {
        margin: 0 120px;
    }
</style>