import {find} from 'lodash'

/**
 * Using this trait requires you to manually call the init()
 * to initialize the default data in your vue's life-cycle hook.
 */
export default {
    methods : {
        init() {
            axios.get(`/api/${apiVersion}/currencies`)
                 .then((r) => {
                     this.$store.commit('setCurrencies', r.data);
                     this.$store.commit('setConverterFromCurrency', this.currencyCodes[0]);
                     this.$store.commit('setConverterToCurrency', this.currencyCodes[1]);
                 })
        },

        async calculate(fromAmount, fromCurrency, toCurrency) {
            if (!fromAmount) {
                return {
                    amount : '',
                    fees : '',
                }
            }

            fromAmount = parseFloat(fromAmount);

            let res = await axios.get(`/api/${apiVersion}/calculate-currency`, {
                params : {
                    fromCurrency : fromCurrency,
                    toCurrency : toCurrency,
                    fromAmount : fromAmount,
                }
            });

            return res.data;
        },

        setAvailablePaymentModes(fromCurrency) {
            let currency = find(this.$store.state.currencies, { 'code' : fromCurrency });

            this.$store.commit('setPaymentModes', currency.payment_modes);
        },

        handleFromAmountInput() {
            let result = this.calculate(this.fromAmount, this.fromCurrency, this.toCurrency)

            result.then((r) => {
                this.$store.commit('setConverterToAmount', r.amount);
                this.$store.commit('setConverterFee', r.fees);
            })
        },

        handleToAmountInput() {
            let result = this.calculate(this.toAmount, this.toCurrency, this.fromCurrency);

            result.then((r) => {
                this.$store.commit('setConverterFromAmount', r.amount);
                this.$store.commit('setConverterFee', r.fees);
            })
        },

        handleFromCurrencySelect(currency) {
            this.$store.commit('setConverterFromCurrency', currency);

            let result = this.calculate(this.fromAmount, this.fromCurrency, this.toCurrency);

            result.then((r) => {
                this.$store.commit('setConverterToAmount', r.amount);
                this.$store.commit('setConverterFee', r.fees);
            })

            this.setAvailablePaymentModes(this.fromCurrency)
        },

        handleToCurrencySelect(currency) {
            this.$store.commit('setConverterToCurrency', currency);

            let result = this.calculate(this.toAmount, this.toCurrency, this.fromCurrency);

            result.then((r) => {
                this.$store.commit('setConverterFromAmount', r.amount);
                this.$store.commit('setConverterFee', r.fees);
            })

            this.setAvailablePaymentModes(this.fromCurrency)
        },
    },

    computed : {
        hasCurrencyCodes() {
            return this.currencyCodes.length > 0;
        },

        currencyCodes() {
            return this.$store.getters.currencyCodes
        },

        fromCurrency() {
            return this.$store.state.converter.fromCurrency;
        },

        toCurrency() {
            return this.$store.state.converter.toCurrency;
        },

        fromAmount() {
            return this.$store.state.converter.fromAmount;
        },

        toAmount() {
            return this.$store.state.converter.toAmount;
        },
    },
}