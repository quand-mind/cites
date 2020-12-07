<template>
    <div>
        <div class="mb-5 ml-5">
            <h1 class="">Links</h1>
            <h5 class="secondary">Agrega una nuevo link</h5>
        </div>
        <div class="d-flex mb-5 ml-5 w-100">
            <b-form class="social-form mr-5" @submit.prevent="onSubmit">
                <b-form-group
                    label="Nombre:"
                    label-for="name"
                >
                    <b-form-input
                        id="name"
                        v-model="form.name"
                        required
                    ></b-form-input>
                </b-form-group>
                <b-form-group
                    label="URL:"
                    label-for="url"
                >
                    <b-form-input
                        id="name"
                        v-model="form.url"
                        required
                    ></b-form-input>
                </b-form-group>
                <b-form-group class="user-photo">
                    <picture>
                        <b-img thumbnail fluid :src="photoURL" alt="link icon"></b-img>
                    </picture>
                    <b-form-file
                        accept="image/*"
                        v-model="form.photo"
                        placeholder="Escoge una foto(Max. 2MB)"
                        drop-placeholder="Subir archivo aquí..."
                        max-size="2048"
                    ></b-form-file>
                </b-form-group>

                <b-row class="mt-5">
                    <b-col>
                        <b-button class="submit-btn " size="lg" type="submit" variant="primary">Agregar Link</b-button>
                    </b-col>
                </b-row>
            </b-form>
            <b-list-group class="ml-5" style="max-width: 300px;">
                <draggable v-bind="dragOptions" v-model="links" :move="handleMove">
                    <transition-group class="d-flex flex-wrap" type="transition" name="flip-list">
                        <b-list-group-item v-for="(link, ind) in links" :key="'key-' + ind" class="d-flex align-items-center link">
                            <b-avatar variant="info" :src="link.photo" class="mr-3"></b-avatar>
                            <span class="mr-auto">{{ link.name }}</span>
                            <div class="actions">
                                <b-button :class="{'text-secondary': !Boolean(link.isVisible)}" @click="() => toggleIsVisible(link.id)" variant="link">
                                    <font-awesome-icon :icon="['fa', 'eye']"></font-awesome-icon>
                                </b-button>         
                                <a class="text-primary" :href="link.url" target="_blank">
                                    <font-awesome-icon :icon="['fa', 'link']"></font-awesome-icon>
                                </a>                       
                                <b-button @click="() => deleteSocialLink(link.id)" class="text-danger" variant="link">
                                    <font-awesome-icon :icon="['fa', 'trash']"></font-awesome-icon>
                                </b-button>                       
                            </div>
                        </b-list-group-item>
                    </transition-group>
                </draggable>
            </b-list-group>
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
    components: {
        draggable,
        vueDropzone: vue2Dropzone
    },
    props: [
        'linksList'
    ],
    data: () => ({
        dropzoneOptions: {
            url: '#',
            paramName: 'photo',
            uploadMultiple: true,
            maxFilesize: 2048,
            thumbnailWidth: 300,
            addRemoveLinks: true,
            dictDefaultMessage: "<i class='fa fa-cloud-upload'></i> CARGAR IMAGEN (Máx. 2MB)",
            acceptedFiles: 'image/*',
            headers: {
                'x-csrf-token': document.querySelector('meta[name="csrf-token"]').content
            }
        },
        links: [],
        form: {
            name: null,
            url: null,
            photo: null,
        }
    }),
    methods: {
        handleMove(e,a) {
            var aux = 0
            aux = this.links[e.draggedContext.index].image_order
            this.links[e.draggedContext.index].image_order = this.links[e.relatedContext.index].image_order
            this.links[e.relatedContext.index].image_order = aux
        },
        updateLinks () {
            const _this = this

            axios
                .get(`/dashboard/social-links/list`)
                .then(res => {
                    _this.links = [...res.data]
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
        toggleIsVisible(id) {
            const _this = this

            axios
                .get('/dashboard/social-links/toggleIsVisible/' + id)
                .then(res => {
                    _this.makeToast(res.data)
                    _this.updateLinks()
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
        deleteSocialLink(id) {
            const _this = this

            axios
                .delete('/dashboard/social-links/' + id)
                .then(res => {
                    _this.makeToast(res)
                    _this.updateLinks()
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
        onSubmit () {
            // Store the new link
            const _this = this

            let form = new FormData();

            Object.keys(_this.form).forEach(key => {
                form.append(key, _this.form[key]);
            });

            axios
                .post(`/dashboard/social-links/create`, form, {
                    headers: {
                        "Content-Type": "multipart/form-data"
                    }
                })
                .then(res => {
                    _this.makeToast(res.data);
                    _this.updateLinks()
                })
                .catch(err => {
                    let { data } = err.response

                    if (data.errors !== undefined || data.errors !== null) {
                        let errors = Object.values(data.errors).toString()
                        _this.makeToast(errors, "danger");
                    } else {
                        _this.makeToast(data, "danger");
                    }
                });
        },
        makeToast(msg, variant = "success", delay = 3000, append = false) {
            this.$bvToast.toast(`${msg}`, {
                title: "Evento de actualización de usuario",
                autoHideDelay: delay,
                appendToast: append,
                variant
            });
        },
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
        photoURL() {
            return this.form.photo ? URL.createObjectURL(this.form.photo) : null;
        },
    },
    mounted() {
        this.links = [...this.linksList]
    }
}
</script>

<style scoped lang="scss">
    .social-form {
        max-width: 400px;
    }

    .link {
        width: 100%;
        max-width: 400px;
    }
</style>