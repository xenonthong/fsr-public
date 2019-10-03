<template>
    <div>
        <vue-headful :title="`Transaction #${this.transaction.id} | FSR`" />
        <navigation />
        <div class="container mx-auto">
            <basic-card>
                <page-title>Transaction #{{ transaction.id }}</page-title>

                <div class="flex flex-wrap pt-4" v-if="transaction">
                    <div class="w-full md:w-1/2">
                        <div class="mb-1">
                            <p class="text-sm text-light-grey leading-snug">{{ $t('Beneficiary name') }}</p>
                            <h5 class="text-lg mb-3">{{ transaction.beneficiary.name }}</h5>
                        </div>

                        <div class="mb-1">
                            <p class="text-sm text-light-grey leading-snug">{{ $t('Bank name') }}</p>
                            <h5 class="text-lg mb-3">{{ transaction.beneficiary.bank.name }}</h5>
                        </div>

                        <div class="mb-1">
                            <p class="text-sm text-light-grey leading-snug">{{ $t('Beneficiary account no.') }}</p>
                            <h5 class="text-lg mb-3">{{ transaction.beneficiary.account_number }}</h5>
                        </div>

                        <div class="mb-1">
                            <p class="text-sm text-light-grey leading-snug">{{ $t('Conversion') }}</p>
                            <h5 class="text-lg mb-3">
                                {{ transaction.from_currency }} {{ transaction.from_amount }}
                                -
                                {{ transaction.to_currency }} {{ transaction.to_amount }}
                                <br />
                                <span v-if="transaction.fees" class="inline-block text-xs text-light-grey -mt-1">{{ $t('Fees') }} : {{ transaction.from_currency }} {{ transaction.fees }}</span>
                            </h5>
                        </div>
                    </div>
                    <div class="w-full md:w-1/2">
                        <div class="mb-1">
                            <p class="text-sm text-light-grey leading-snug">{{ $t('Status') }}</p>
                            <h5 class="text-lg mb-3 capitalize">{{ $t(transaction.status) }}</h5>
                        </div>

                        <div class="mb-1" v-if="transaction.status === 'pending payment'">
                            <p class="text-sm text-light-grey leading-snug">{{ $t('Proof of payment') }}</p>
                            <div class="-mt-2">
                                <uploader
                                    @file-selected="selectedProof"
                                    :options="{
                                        limit: 1,
                                        fileMaxSize: 3,
                                        extensions: ['jpg', 'jpeg', 'png'],
                                        addMore: false
                                    }"
                                ></uploader>

                                <action-button v-if="proof" @click="uploadProof">{{ $t('upload') }}</action-button>
                            </div>
                        </div>

                        <div class="mt-1">
                            <p class="text-sm text-light-grey leading-snug">{{ $t('Payment proof') }}</p>
                            <div class="flex flex-wrap -mx-2">
                                <div class="w-full md:w-1/3 p-2" v-for="media in transaction.media" :key="media.id">
                                    <img :src="media.full_url" @click="$modal.show(`payment-${media.id}`);" />

                                    <modal :name="`payment-${media.id}`" height="auto" :adaptive="true">
                                        <img class="w-full" :src="media.full_url" />
                                    </modal>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </basic-card>
        </div>
        <help />
        <div class="mt-20">
            <v-footer />
        </div>
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
            transaction: null,
            proof: null,
            errors: []
        };
    },

    mounted() {
        this.getTransaction();
    },

    methods: {
        getTransaction() {
            axios
                .get(`/transactions/${this.$route.params.id}`)
                .then(r => {
                    this.transaction = r.data.transaction;
                    console.log(r.data.transaction.media);
                })
                .catch(() => {
                    this.$toasted.error("Unable to retrieve transaction.");
                });
        },

        selectedProof(fileList) {
            this.proof = fileList[0];
        },

        uploadProof() {
            let formData = new FormData();
            formData.append("proof", this.proof);

            axios
                .post(`/transactions/${this.transaction.id}/proof`, formData, {
                    headers: {
                        "Content-Type": "multipart/form-data"
                    }
                })
                .then(r => {
                    this.errors = [];

                    this.$router.push({ name: "account" });
                    this.$toasted.success(r.data);
                })
                .catch(err => {
                    if (err.response.status === 403) {
                        this.$toasted.error(err.response.data);
                    }

                    this.errors = err.response.data.errors;
                });
        }
    },

    computed: {
        hasErrors() {
            return size(this.errors) > 0;
        }
    }
};
</script>

<style scoped>
</style>
