<template>
    <div>
        <vue-headful title="Send money overseas | FSR" />
        <navigation/>
        <div class="container mx-auto">
            <basic-card>
                <div class="mb-3">
                    <page-title>{{ $t('Beneficiary') }}</page-title>
                </div>
                <div class="mb-10" v-if="beneficiary">
                    <div class="md:w-1/2">
                        <page-subtitle>{{ beneficiary.name }}</page-subtitle>
                        <p class="text-sm leading-snug">
                            {{ beneficiary.bank.name }}
                            <br>
                            {{ beneficiary.account_number }}
                        </p>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="mb-3">
                        <page-title>{{ $t('Remittance details') }}</page-title>
                    </div>

                    <div class="md:border-2 border-off-white flex flex-wrap">
                        <div class="bg-off-white md:w-1/2">
                            <div class="p-5 md:p-10 text-lg md:text-2xl">
                                <h3 class="mb-5 text-lg">{{ $t('Transfer from') }}</h3>

                                <div class="mb-4">
                                    <v-select :label="$t('Source of fund')"
                                              v-if="sources.length > 0"
                                              :selected-option="sources[0].value"
                                              :options="sources"
                                              @selected="(val) => this.selectedSource = val"
                                    />
                                </div>

                                <div class="mb-4">
                                    <currency-select :label="$t('Currency')"
                                                     :selected-option="$store.getters.defaultConverterFromCurrency"
                                                     :options="currencyCodes"
                                                     @selected="handleFromCurrencySelect"
                                                     v-if="hasCurrencyCodes">
                                    </currency-select>
                                </div>

                                <div class="mb-4">
                                    <currency-input state-name="fromAmount"
                                                    :label="$t('Amount')"
                                                    @on-input="handleFromAmountInput"
                                    />

                                    <div class="text-xs mt-2 text-grey" v-if="$store.state.converter.fees">
                                        ({{ $t('Excludes') }} {{ $store.state.converter.fees }} {{ $store.state.converter.fromCurrency }} {{ $t('Fees') }})
                                    </div>

                                    <div class="mt-5 text-grey text-sm"
                                         v-if="$store.state.authUser.points_available >= 100">
                                        <p-check class="p-default p-curve" v-model="usePoints">
                                            <div class="pl-1">{{ $t('Use points for free transfer') }}</div>
                                        </p-check>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="md:w-1/2">
                            <div class="p-5 md:p-10 text-lg md:text-2xl">
                                <h3 class="mb-5 text-lg">{{ $t('Transfer to') }}</h3>

                                <div class="mb-4">
                                    <v-select :label="$t('Purpose')"
                                              v-if="purposes.length > 0"
                                              :selected-option="purposes[0].value"
                                              :options="purposes"
                                              @selected="(val) => this.selectedPurpose = val"
                                    />
                                </div>

                                <div class="mb-4">
                                    <currency-select :label="$t('Currency')"
                                                     :selected-option="$store.getters.defaultConverterToCurrency"
                                                     :options="currencyCodes"
                                                     @selected="handleToCurrencySelect"
                                                     v-if="hasCurrencyCodes">
                                    </currency-select>
                                </div>

                                <div class="mb-4">
                                    <currency-input state-name="toAmount"
                                                    :label="$t('Amount')"
                                                    @on-input="handleToAmountInput"
                                    />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </basic-card>

            <div class="my-10">
                <div class="md:w-1/2 mx-auto">
                    <div class="text-center">
                        <page-title>
                            {{ $t("Multiple Ways To Send Money. All-In-One Flexibility.") }}
                        </page-title>
                        <p>
                            {{ $t("To send money to your dear ones you only need to place a request, then pay using one of the following methods:") }}
                        </p>
                    </div>
                </div>
                <div class="md:w-3/5 lg:w-2/5 mx-auto mt-5">
                    <div class="flex flex-wrap">
                        <div class="w-full md:w-1/2 p-3" @click="storeTransaction('bank transfer')">
                            <div class="p-5 rounded-lg border-2"
                                 :class="paymentModeClasses('bank transfer')"
                                 style="min-height: 14rem">

                                <h3 class="text-lg leading-snug text-blue-grey">
                                    {{ $t('payment.modes.1.title') }}
                                </h3>

                                <p class="mt-3 text-light-grey text-sm leading-snug">
                                    {{ $t('payment.modes.1.content', [settings.bank_name, settings.bank_account]) }}
                                </p>
                            </div>
                        </div>

                        <div class="w-full md:w-1/2 p-3" @click="storeTransaction('japan card')">
                            <div class="p-5 rounded-lg border-2"
                                 :class="paymentModeClasses('japan card')"
                                 style="min-height: 14rem">

                                <h3 class="text-lg leading-snug text-blue-grey">
                                    {{ $t('payment.modes.2.title') }}
                                </h3>

                                <p class="mt-3 text-light-grey text-xs leading-snug">
                                    {{ $t('payment.modes.2.content', [settings.bank_name, settings.bank_account]) }}
                                </p>
                            </div>
                        </div>

                        <div class="w-full md:w-1/2 p-3" @click="storeTransaction('japan bank')">
                            <div class="p-5 rounded-lg border-2"
                                 :class="paymentModeClasses('japan bank')"
                                 style="min-height: 14rem">

                                <h3 class="text-lg leading-snug text-blue-grey">
                                    {{ $t('payment.modes.3.title') }}
                                </h3>

                                <p class="mt-3 text-light-grey text-sm leading-snug">
                                    {{ $t('payment.modes.3.content') }}
                                </p>
                            </div>
                        </div>

                        <div class="w-full md:w-1/2 p-3" @click="storeTransaction('walk in')">
                            <div class="p-5 rounded-lg border-2"
                                 :class="paymentModeClasses('walk in')"
                                 style="min-height: 14rem">

                                <h3 class="text-lg leading-snug text-blue-grey">
                                    {{ $t('payment.modes.4.title') }}
                                </h3>

                                <p class="mt-3 text-light-grey text-sm leading-snug">
                                    {{ $t('payment.modes.4.content') }}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="mb-8" v-if="hasErrors">
                        <form-errors :errors="errors"/>
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
    import Help from "../components/sections/Help";
    import currencyCalculatorTrait from '../traits/currency-calculator';
    import CurrencyInput from '../components/forms/CurrencyInput';
    import { map, size } from 'lodash';

    export default {
        components : {
            Help,
            CurrencyInput
        },

        data() {
            return {
                beneficiary : null,
                sources : [],
                purposes : [],
                selectedSource : null,
                selectedPurpose : null,
                errors : [],
                usePoints : false,
            }
        },

        mounted() {
            this.getBeneficiary();
            this.getFundSources();
            this.getPurposes();
            this.init();
        },

        methods : {
            storeTransaction(paymentMode) {
                if (!this.hasPaymentMode(paymentMode)) return;

                axios.post(`/transactions`, {
                    'beneficiary_id' : this.beneficiary.id,
                    'source_of_funds' : this.selectedSource,
                    'purpose' : this.selectedPurpose,
                    'from_amount' : this.$store.state.converter.fromAmount,
                    'to_amount' : this.$store.state.converter.toAmount,
                    'from_currency' : this.$store.state.converter.fromCurrency,
                    'to_currency' : this.$store.state.converter.toCurrency,
                    'fees' : this.$store.state.converter.fees,
                    'use_points' : this.usePoints,
                    'payment_mode' : paymentMode
                })
                     .then((r) => {
                         this.$router.push({name : 'account'});
                         this.$store.commit('setAuthUserPoints', r.data.points);
                         this.$toasted.success('Transfer request submitted');
                     })
                     .catch((e) => {
                         if (e.response.status === 403) {
                             this.$toasted.error(e.response.data)
                         }

                         if (e.response.status === 422) {
                             this.errors = e.response.data.errors;
                         }
                     })
            },

            getBeneficiary() {
                axios.get(`/beneficiaries/${this.$route.params.id}`)
                     .then((r) => {
                         this.beneficiary = r.data.beneficiary;
                     })
                     .catch(() => {
                         this.$toasted.error('Unable to retrieve beneficiary.')
                     })
            },

            getPurposes() {
                axios.get(`/api/${apiVersion}/transfer-purposes`)
                     .then((r) => {
                         this.purposes = map(r.data, (source) => {
                             return {
                                 display : source,
                                 value : source,
                             }
                         })
                     })
            },

            getFundSources() {
                axios.get(`/api/${apiVersion}/fund-sources`)
                     .then((r) => {
                         this.sources = map(r.data, (source) => {
                             return {
                                 display : source,
                                 value : source,
                             }
                         })
                     })
            },

            paymentModeClasses(mode) {
                let hasPaymentMode = this.hasPaymentMode(mode);

                return {
                    'bg-white' : hasPaymentMode,
                    'border-off-white' : !hasPaymentMode,
                    'bg-off-white' : !hasPaymentMode,
                }
            },

            /**
             * Available options:
             * - "bank transfer"
             * - "japan card"
             * - "japan bank"
             * - "walk in"
             *
             * @param name
             */
            hasPaymentMode(name) {
                console.log(this.$store.state.paymentModes);
                return this.$store.state.paymentModes.indexOf(name) !== -1;
            },

            ...currencyCalculatorTrait.methods
        },

        computed : {
            hasErrors() {
                return size(this.errors) > 0;
            },

            settings() {
                return window.appSettings;
            },

            ...currencyCalculatorTrait.computed
        },
    }
</script>