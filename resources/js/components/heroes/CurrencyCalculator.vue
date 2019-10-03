<template>
    <div class="bg-off-white pt-12 pb-10 px-4 lg:p-10 calculator-shadow">
        <div class="mb-3">
            <div class="flex flex-wrap">
                <div class="w-1/2 md:w-3/5">
                    <currency-input arrow-direction="down"
                                    state-name="fromAmount"
                                    @on-input="handleFromAmountInput"
                    >
                        <template v-slot:label>
                            {{ $t('You send') }}
                        </template>
                    </currency-input>
                </div>
                <div class="w-1/2 md:w-2/5 pt-4 pl-6 flex-1 md:w-2/5 self-start">
                    <currency-select :class="{ 'text-2xl' : true }"
                                     :selected-option="currencyCodes[0]"
                                     :options="currencyCodes"
                                     @selected="handleFromCurrencySelect"
                                     v-if="hasCurrencyCodes">
                    </currency-select>
                </div>
            </div>
        </div>

        <div class="flex flex-wrap">
            <div class="w-1/2 md:w-3/5">
                <currency-input arrow-direction="up"
                                state-name="toAmount"
                                @on-input="handleFromAmountInput"
                >
                    <template v-slot:label>
                        {{ $t('Recipient gets') }}
                    </template>
                </currency-input>
            </div>
            <div class="pb-4 pl-6 flex-1 self-end md:w-2/5">
                <currency-select :class="{ 'text-2xl' : true }"
                                 :selected-option="currencyCodes[1]"
                                 :options="currencyCodes"
                                 @selected="handleToCurrencySelect"
                                 v-if="hasCurrencyCodes">
                </currency-select>
            </div>
        </div>

        <div class="mt-12">
            <link-button to="/register" size="2xl">
                {{ $t('Get started') }}
            </link-button>
        </div>
    </div>
</template>

<script>
    import CurrencyInput from './CurrencyInput'
    import currencyCalculatorTrait from '../../traits/currency-calculator';

    export default {
        components : {
            CurrencyInput
        },

        methods : {
            ...currencyCalculatorTrait.methods
        },

        computed : {
            ...currencyCalculatorTrait.computed
        },

        mounted() {
            this.init();
        },

        // created() {
        //     this.debouncedCalculateFromSender = debounce(this.handleFromAmountInput, 500);
        //     this.debouncedCalculateFromRecipient = debounce(this.calculateFromRecipient, 500)
        // }
    }
</script>

<style scoped>
    .calculator-shadow {
        box-shadow: 0px 9px 210px rgba(210, 231, 238, 0.6);
    }
</style>