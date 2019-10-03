import { isEmpty, map } from 'lodash';

export default {
    /**
     * Checks if user is authenticated.
     *
     * @param state
     * @return {boolean}
     */
    isAuthenticated: state => {
        return !isEmpty(state.authUser);
    },

    /**
     * Checks if user is verified.
     *
     * @param state
     * @return {boolean}
     */
    isVerified: state => {
        if (isEmpty(state.authUser)) return false;

        return state.authUser.verification_status === 'verified';
    },

    authUser: state => {
        return state.authUser;
    },

    currencyCodes: state => {
        return map(state.currencies, c => c.code);
    },

    defaultConverterFromCurrency: state => {
        return state.converter.fromCurrency ? state.converter.fromCurrency : this.currencyCodes[0]
    },

    defaultConverterToCurrency: state => {
        return state.converter.toCurrency ? state.converter.toCurrency : this.currencyCodes[1]
    }
}