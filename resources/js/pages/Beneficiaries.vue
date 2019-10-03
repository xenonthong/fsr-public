<template>
    <div>
        <vue-headful title="My beneficiaries | FSR" />
        <navigation/>
        <div class="container mx-auto">
            <div class="bg-white px-6 py-4 rounded-lg border-off-white border-2 md:px-16 md:py-12 lg:px-48 lg:py-24">
                <div class="flex flex-wrap mb-3">
                    <div class="w-full md:w-7/12">
                        <page-title>{{ $t('Beneficiaries') }}</page-title>
                        <p class="leading-snug text-sm">{{ $t("Select a beneficiary to transfer funds to.") }}</p>
                    </div>
                </div>

                <div class="-mx-6">
                    <div class="w-full md:w-7/12">
                        <div class="px-6">
                            <div v-if="beneficiaries.length > 0">
                                <div v-for="(beneficiary, key) in beneficiaries"
                                     class="beneficiary border-b border-grey-lightest py-4"
                                >
                                    <div class="flex flex-wrap leading-tight">
                                        <router-link class="flex-1"
                                                     :to="{
                                                        name: 'transactionCreate',
                                                        params: {
                                                            id: beneficiary.id
                                                        }
                                                     }">
                                            <h5 class="mb-1">{{ beneficiary.name }}</h5>
                                            <h5 class="text-sm font-light">{{ beneficiary.bank.name }}</h5>
                                            <p class="text-sm leading-tight font-light">{{ beneficiary.account_number }}</p>
                                        </router-link>
                                        <div class="flex-initial self-center pl-3">
                                            <div class="md:hidden">
                                                <router-link :to="{
                                                    name: 'beneficiaryEdit',
                                                    params: {
                                                        id: beneficiary.id
                                                    }
                                                }">
                                                    <svg fill="#AEBDCF"
                                                         class="ml-auto"
                                                         xmlns="http://www.w3.org/2000/svg"
                                                         viewBox="0 0 24 24"
                                                         width="30"
                                                         height="30">
                                                        <path d="M12 22a10 10 0 1 1 0-20 10 10 0 0 1 0 20zm0-2a8 8 0 1 0 0-16 8 8 0 0 0 0 16zm0-9a1 1 0 0 1 1 1v4a1 1 0 0 1-2 0v-4a1 1 0 0 1 1-1zm0-4a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                                    </svg>
                                                </router-link>
                                            </div>

                                            <div class="hidden md:block">
                                                <router-link class="p-1 inline-block"
                                                             :to="{
                                                            name: 'beneficiaryEdit',
                                                            params: {
                                                                id: beneficiary.id
                                                            }
                                                        }">
                                                    <svg fill="#AEBDCF"
                                                         xmlns="http://www.w3.org/2000/svg"
                                                         viewBox="0 0 24 24"
                                                         width="24"
                                                         height="24">
                                                        <path d="M9 4.58V4c0-1.1.9-2 2-2h2a2 2 0 0 1 2 2v.58a8 8 0 0 1 1.92 1.11l.5-.29a2 2 0 0 1 2.74.73l1 1.74a2 2 0 0 1-.73 2.73l-.5.29a8.06 8.06 0 0 1 0 2.22l.5.3a2 2 0 0 1 .73 2.72l-1 1.74a2 2 0 0 1-2.73.73l-.5-.3A8 8 0 0 1 15 19.43V20a2 2 0 0 1-2 2h-2a2 2 0 0 1-2-2v-.58a8 8 0 0 1-1.92-1.11l-.5.29a2 2 0 0 1-2.74-.73l-1-1.74a2 2 0 0 1 .73-2.73l.5-.29a8.06 8.06 0 0 1 0-2.22l-.5-.3a2 2 0 0 1-.73-2.72l1-1.74a2 2 0 0 1 2.73-.73l.5.3A8 8 0 0 1 9 4.57zM7.88 7.64l-.54.51-1.77-1.02-1 1.74 1.76 1.01-.17.73a6.02 6.02 0 0 0 0 2.78l.17.73-1.76 1.01 1 1.74 1.77-1.02.54.51a6 6 0 0 0 2.4 1.4l.72.2V20h2v-2.04l.71-.2a6 6 0 0 0 2.41-1.4l.54-.51 1.77 1.02 1-1.74-1.76-1.01.17-.73a6.02 6.02 0 0 0 0-2.78l-.17-.73 1.76-1.01-1-1.74-1.77 1.02-.54-.51a6 6 0 0 0-2.4-1.4l-.72-.2V4h-2v2.04l-.71.2a6 6 0 0 0-2.41 1.4zM12 16a4 4 0 1 1 0-8 4 4 0 0 1 0 8zm0-2a2 2 0 1 0 0-4 2 2 0 0 0 0 4z"/>
                                                    </svg>
                                                </router-link>

                                                <a class="p-1 inline-block"
                                                   href="#"
                                                   @click.prevent="confirmRemove(beneficiary.id)">
                                                    <svg fill="#AEBDCF"
                                                         xmlns="http://www.w3.org/2000/svg"
                                                         viewBox="0 0 24 24"
                                                         width="24"
                                                         height="24">
                                                        <path d="M8 6V4c0-1.1.9-2 2-2h4a2 2 0 0 1 2 2v2h5a1 1 0 0 1 0 2h-1v12a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V8H3a1 1 0 1 1 0-2h5zM6 8v12h12V8H6zm8-2V4h-4v2h4zm-4 4a1 1 0 0 1 1 1v6a1 1 0 0 1-2 0v-6a1 1 0 0 1 1-1zm4 0a1 1 0 0 1 1 1v6a1 1 0 0 1-2 0v-6a1 1 0 0 1 1-1z"/>
                                                    </svg>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div v-else>
                                <page-subtitle>
                                    Looks like you don't have any beneficiary.
                                </page-subtitle>
                            </div>

                            <div class="md:w-1/2 mt-4">
                                <link-button :to="{ name: 'beneficiaryCreate' }">
                                    {{ $t('Add') }} {{ $t('Beneficiary') }}
                                </link-button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <help/>
        <div class="mt-20">
            <v-footer/>
        </div>
        <modal name="confirm-delete"
               height="auto"
               :adaptive="true">
            <div class="p-6">
                <div class="mb-3">
                    <modal-title>Are you sure?</modal-title>
                </div>

                <p class="mb-6 leading-snug">
                    By clicking 'confirm' this beneficiary will be deleted.
                </p>

                <div class="flex flex-wrap -mx-3">
                    <div class="flex-1 px-3">
                        <modal-cancel modal-name="confirm-delete">Cancel</modal-cancel>
                    </div>
                    <div class="flex-1 px-3">
                        <action-button @click="remove()">Confirm</action-button>
                    </div>
                </div>
            </div>
        </modal>
    </div>
</template>

<script>
    import Help from "../components/sections/Help";

    export default {
        components : {
            Help
        },

        data() {
            return {
                beneficiaries : [],
                deleteId : null,
            }
        },

        mounted() {
            this.getBeneficiaries();
        },

        methods : {
            getBeneficiaries() {
                axios.get('/beneficiaries')
                     .then((r) => {
                         this.beneficiaries = r.data.beneficiaries;
                     })
                     .catch((err) => {
                         this.$toasted.error('Unable to retrieve beneficiaries.')
                     })
            },

            confirmRemove(id) {
                this.deleteId = id;

                this.$modal.show('confirm-delete');
            },

            remove() {
                axios.delete(`/beneficiaries/${this.deleteId}`)
                     .then((r) => {
                         if (r.data.result === true) {
                             this.$toasted.success('Beneficiary deleted.');

                             return;
                         }

                         this.$toasted.error('Unable to update beneficiary.');
                     })
            },

            isLastBeneficiary(key) {
                return key + 1 === beneficiaries.length
            }
        },
    }
</script>

<style scoped>
    .beneficiary:last-of-type {
        border-bottom: 0;
    }
</style>