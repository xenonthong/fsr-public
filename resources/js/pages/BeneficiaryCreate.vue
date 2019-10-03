<template>
    <div>
        <vue-headful title="Add new beneficiary | FSR" />
        <navigation/>
        <div class="container mx-auto">
            <div class="bg-white px-6 py-4 rounded-lg border-off-white border-2 md:px-16 md:py-12 lg:px-48 lg:py-24">
                <page-title>{{ $t('Add new beneficiary') }}</page-title>
                <div class="-mx-6">
                    <div class="w-full md:w-7/12">
                        <div class="px-6 py-4">
                            <div class="mb-8" v-if="hasErrors">
                                <form-errors :errors="errors"/>
                            </div>

                            <form @submit.prevent="save">
                                <div class="mb-4">
                                    <v-input @on-input="(val) => this.name = val"
                                             :value="name"
                                             :label="$t('Name')"/>
                                </div>

                                <div class="mb-4">
                                    <v-select :label="$t('Bank')"
                                              :selected-option="defaultBank"
                                              :options="banks"
                                              @selected="(val) => this.selected_bank = val"
                                              v-if="banks.length > 0">
                                    </v-select>
                                </div>

                                <div class="mb-8">
                                    <v-input @on-input="(val) => this.account_number = val"
                                             :value="account_number"
                                             :label="$t('Account no.')"/>
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
        <help/>
        <div class="mt-20">
            <v-footer/>
        </div>
    </div>
</template>

<script>
    import { size } from 'lodash';
    import Help from "../components/sections/Help";

    export default {
        components : {
            Help
        },

        data() {
            return {
                name : null,
                account_number : null,
                selected_bank : null,
                banks : [],
                errors: [],
            }
        },

        mounted() {
            this.getBanks();
        },

        methods : {
            save() {
                axios.post(`/beneficiaries/`, {
                    name : this.name,
                    bank_id : this.selected_bank,
                    account_number : this.account_number
                })
                     .then((r) => {
                         this.$toasted.success(r.data);

                         this.$router.push({ name: 'beneficiaries' })
                     })
                     .catch((err) => {
                         this.errors = err.response.data.errors;
                     });
            },

            getBanks() {
                axios.get('/banks')
                     .then((r) => {
                         this.banks = r.data.banks;
                     })
                     .catch(() => {
                         this.$toasted.error('Unable to get list of banks.')
                     })
            }
        },

        computed : {
            defaultBank() {
                return this.banks[0].value
            },

            hasErrors () {
                return size(this.errors) > 0;
            }
        },
    }
</script>