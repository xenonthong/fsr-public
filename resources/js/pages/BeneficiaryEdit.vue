<template>
    <div>
        <vue-headful :title="`${this.beneficiary.name} | FSR`" />
        <navigation />
        <div class="container mx-auto">
            <div class="bg-white px-6 py-4 rounded-lg border-off-white border-2 md:px-16 md:py-12 lg:px-48 lg:py-24">
                <div class="flex flex-wrap">
                    <div class="w-full md:w-7/12">
                        <div class="flex flex-wrap px-6 -mx-6">
                            <div class="flex-auto">
                                <page-title>{{ $t('Edit') }} {{ $t('Beneficiary') }}</page-title>
                            </div>
                            <div class="flex-initial self-center">
                                <a href="#" @click.prevent="confirmRemove()">
                                    <svg fill="#AEBDCF" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="30" height="30">
                                        <path d="M8 6V4c0-1.1.9-2 2-2h4a2 2 0 0 1 2 2v2h5a1 1 0 0 1 0 2h-1v12a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V8H3a1 1 0 1 1 0-2h5zM6 8v12h12V8H6zm8-2V4h-4v2h4zm-4 4a1 1 0 0 1 1 1v6a1 1 0 0 1-2 0v-6a1 1 0 0 1 1-1zm4 0a1 1 0 0 1 1 1v6a1 1 0 0 1-2 0v-6a1 1 0 0 1 1-1z" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="-mx-6">
                    <div class="w-full md:w-7/12">
                        <div class="px-6 py-4">
                            <div class="mb-8" v-if="hasErrors">
                                <form-errors :errors="errors" />
                            </div>

                            <form v-if="beneficiary" @submit.prevent="save">
                                <div class="mb-4">
                                    <v-input @on-input="(val) => this.beneficiary.name = val" :value="beneficiary.name" label="Name" />
                                </div>

                                <div class="mb-4">
                                    <v-select label="Bank" :selected-option="defaultBank" :options="banks" @selected="(val) => this.selected_bank = val" v-if="banks.length > 0"></v-select>
                                </div>

                                <div class="mb-8">
                                    <v-input @on-input="(val) => this.beneficiary.account_number = val" :value="beneficiary.account_number" label="Account no." />
                                </div>

                                <div class="flex flex-wrap -mx-2">
                                    <div class="w-full md:w-1/3 p-2">
                                        <v-button>{{ $t('Save') }}</v-button>
                                    </div>
                                    <div class="w-full md:w-1/3 p-2">
                                        <back-button>{{ $t('Cancel') }}</back-button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <help />
        <div class="mt-20">
            <v-footer />
        </div>
        <modal name="confirm-delete" height="auto" :adaptive="true">
            <div class="p-6">
                <div class="mb-3">
                    <modal-title>Are you sure?</modal-title>
                </div>

                <p class="mb-6 leading-snug">By clicking 'confirm' this beneficiary will be deleted.</p>

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
import { size } from "lodash";
import Help from "../components/sections/Help";

export default {
    components: {
        Help
    },

    data() {
        return {
            beneficiary: null,
            banks: [],
            selected_bank: null,
            errors: []
        };
    },

    mounted() {
        this.getBeneficiary();
        this.getBanks();
    },

    methods: {
        getBeneficiary() {
            axios
                .get(`/beneficiaries/${this.$route.params.id}`)
                .then(r => {
                    this.beneficiary = r.data.beneficiary;
                })
                .catch(() => {
                    this.$toasted.error("Unable to retrieve beneficiary.");
                });
        },

        save() {
            axios
                .put(`/beneficiaries/${this.$route.params.id}`, {
                    name: this.beneficiary.name,
                    bank_id: this.selected_bank,
                    account_number: this.beneficiary.account_number
                })
                .then(r => {
                    this.$toasted.success("Beneficiary has been updated.");
                })
                .catch(err => {
                    this.errors = err.response.data.errors;
                });
        },

        remove() {
            axios.delete(`/beneficiaries/${this.$route.params.id}`).then(r => {
                if (r.data.result === true) {
                    this.$router.push({ name: "beneficiaries" });

                    return;
                }

                this.$toasted.error("Unable to update beneficiary.");
            });
        },

        confirmRemove() {
            this.$modal.show("confirm-delete");
        },

        getBanks() {
            axios
                .get("/banks")
                .then(r => {
                    this.banks = r.data.banks;
                })
                .catch(() => {
                    this.$toasted.error("Unable to get list of banks.");
                });
        }
    },

    computed: {
        defaultBank() {
            return this.beneficiary.bank_id
                ? this.beneficiary.bank_id
                : this.banks[0].value;
        },

        hasErrors() {
            return size(this.errors) > 0;
        }
    }
};
</script>

<style scoped>
.beneficiary:last-of-type {
    border-bottom: 0;
}
</style>
