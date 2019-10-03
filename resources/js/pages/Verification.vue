<template>
    <div>
        <vue-headful title="Verify your account | FSR" />
        <navigation/>
        <div class="container mx-auto">
            <basic-card>
                <div class="mb-5">
                    <page-title>Account verification</page-title>
                </div>

                <div class="mb-12" v-if="hasErrors">
                    <form-errors :errors="errors"/>
                </div>

                <div class="w-full md:w-7/12">
                    <div class="mb-6">
                        <helper-text>A self-protrait of yourself holding your identification document.</helper-text>

                        <uploader @file-selected="updateSelfPortrait"
                                  :options="{
                                    limit: 1,
                                    extensions: ['jpg', 'jpeg', 'png'],
                                    addMore: false
                                  }"
                        />
                    </div>

                    <div>
                        <helper-text>Document (Front)</helper-text>

                        <uploader @file-selected="updateDocumentFront"
                                  :options="{
                                    limit: 1,
                                    extensions: ['jpg', 'jpeg', 'png'],
                                    addMore: false
                                  }"
                        />

                        <div class="mt-3">
                            <helper-text>Document (Back)</helper-text>

                            <uploader @file-selected="updateDocumentRear"
                                      :options="{
                                            limit: 1,
                                            extensions: ['jpg', 'jpeg', 'png'],
                                            addMore: false
                                          }"
                            />
                        </div>
                    </div>

                    <div class="mt-12 w-full md:w-1/2">
                        <div class="flex flex-wrap">
                            <div class="w-full md:w-1/2">
                                <div class="mb-3 md:mr-2 md:mb-0">
                                    <back-button>Back</back-button>
                                </div>
                            </div>

                            <div class="w-full md:w-1/2">
                                <div class="text-white border border-purple bg-purple p-3 text-center w-full rounded cursor-pointer"
                                     @click="submit">Verify
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </basic-card>
        </div>
        <help/>
        <div class="mt-20">
            <v-footer/>
        </div>
    </div>
</template>

<script>
    import Help from "../components/sections/Help";
    import size from 'lodash';

    export default {
        components : {
            Help
        },

        data() {
            return {
                portrait : null,
                documentFront : null,
                documentRear : null,
                errors : [],
            }
        },

        methods : {
            updateSelfPortrait(fileList) {
                this.portrait = fileList[0];
            },

            updateDocumentFront(fileList) {
                this.documentFront = fileList[0];
            },

            updateDocumentRear(fileList) {
                this.documentRear = fileList[0];
            },

            submit() {
                let formData = new FormData();
                formData.append('portrait', this.portrait);
                formData.append('documentFront', this.documentFront);
                formData.append('documentRear', this.documentRear);
                formData.append('contactNumber', this.contactNumber);

                axios.post('/verification', formData, {
                    headers : {
                        'Content-Type' : 'multipart/form-data'
                    }
                })
                     .then((r) => {
                         this.errors = [];

                         this.$router.push({ name: 'account' });
                         this.$toasted.success(r.data);
                     })
                     .catch((err) => {
                         if (err.response.status === 403) {
                             this.$toasted.error(err.response.data);
                         }

                         this.errors = err.response.data.errors
                     });
            }
        },

        computed : {
            hasErrors () {
                return size(this.errors) > 0;
            }
        }
    }
</script>