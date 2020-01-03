<template>
    <div>
        <b-form @submit="onSubmit" @reset="onReset">
            <b-container>
                <b-row>
                    <b-col>
                        <b-form-group label="Título" label-for="input-1">
                            <b-form-input
                                v-model="form.title"
                                required
                                placeholder="Titulo del Post"
                            ></b-form-input>
                        </b-form-group>
                    </b-col>
                </b-row>
            </b-container>

            <b-container>
                <b-row>
                    <b-col>
                        <b-form-group
                            id="input-group-2"
                            label="Descripción"
                            label-for="input-2"
                        >
                            <b-form-textarea
                                id="input-2"
                                v-model="form.meta_description"
                                required
                                rows="4"
                                placeholder="Meta descripción"
                            ></b-form-textarea>
                        </b-form-group>
                    </b-col>
                    <b-col>
                        <b-form-group
                            id="input-group-2"
                            label="Robots"
                            label-for="input-2"
                        >
                            <b-form-textarea
                                id="input-2"
                                v-model="form.meta_robots"
                                required
                                rows="4"
                                placeholder="Meta robots"
                            ></b-form-textarea>
                        </b-form-group>
                    </b-col>
                </b-row>
            </b-container>

            <b-container>
                <b-row>
                    <b-col>
                        <b-form-group
                            id="input-group-2"
                            label="Robots"
                            label-for="input-2"
                        >
                            <b-form-textarea
                                id="input-2"
                                v-model="form.meta_keywords"
                                required
                                rows="4"
                                placeholder="Palabras claves"
                            ></b-form-textarea>
                        </b-form-group>
                    </b-col>
                    <b-col>
                        <b-form-group
                            id="input-group-3"
                            label="Publicar post"
                            label-for="input-3"
                            description="Estando activo el post será visible al público"
                        >
                            <b-form-checkbox
                                v-model="form.is_active"
                                name="check-button"
                                size="lg"
                                switch
                            ></b-form-checkbox>
                        </b-form-group>
                    </b-col>
                </b-row>
            </b-container>
            <b-container>
                <b-row>
                    <b-col>
                        <b-form-group label="Contenido" label-for="input-3">
                            <vue-editor
                                useCustomImageHandler
                                @image-added="handleImageAdded"
                                v-model="form.content"
                            ></vue-editor>
                        </b-form-group>
                    </b-col>
                </b-row>
            </b-container>
        </b-form>
        <b-card class="mt-3" header="Form Data Result">
            <pre class="m-0">{{ form }}</pre>
        </b-card>
    </div>
</template>

<script>
import { VueEditor } from "vue2-editor";
export default {
    props: ["post"],
    components: {
        VueEditor
    },
    data: () => ({
        form: {
            title: "",
            meta_description: "",
            meta_robots: "",
            meta_keywords: "",
            is_active: false,
            content: ""
        }
    }),
    methods: {
        onSubmit() {},
        onReset() {},
        handleImageAdded: function(
            file,
            Editor,
            cursorLocation,
            resetUploader
        ) {
            // An example of using FormData
            // NOTE: Your key could be different such as:
            // formData.append('file', file)

            var formData = new FormData();
            formData.append("image", file);

            axios({
                url: "/images/post",
                method: "POST",
                data: formData
            })
                .then(result => {
                    let url = result.data.url; // Get url from response
                    Editor.insertEmbed(cursorLocation, "image", url);
                    resetUploader();
                })
                .catch(err => {
                    console.log(err);
                });
        }
    }
};
</script>
