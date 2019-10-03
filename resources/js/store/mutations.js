export default {
    /**
     * Set currencies and their conversions.
     */
    setCurrencies(state, payload) {
        state.currencies = payload;
    },

    /**
     * Set the 'from' currency code
     */
    setConverterFromCurrency(state, payload) {
        state.converter.fromCurrency = payload;
    },

    /**
     * Set the 'from' currency code
     */
    setConverterToCurrency(state, payload) {
        state.converter.toCurrency = payload;
    },

    /**
     * Set the 'to' currency code
     */
    setConverterToAmount(state, payload) {
        state.converter.toAmount = payload
    },

    /**
     * Set the 'from' currency code
     */
    setConverterFromAmount(state, payload) {
        state.converter.fromAmount = payload
    },

    /**
     * Set the 'from' currency code
     */
    setConverterFee(state, payload) {

        state.converter.fees = payload;
    },

    /**
     * Set available payment modes base on selected currency.
     */
    setPaymentModes(state, payload) {
        state.paymentModes = payload;
    },

    /**
     * Set the current authenticated user.
     *
     * @param state
     * @param payload
     */
    setAuthUser(state, payload) {
        state.authUser = payload;
    },

    setAuthUserPoints(state, payload) {
        state.authUser.points_available = payload;
    },

    setLanguage(state, payload) {
        state.lang = payload;
    }
}