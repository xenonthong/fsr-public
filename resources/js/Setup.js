import Vue from 'vue';
import VueRouter from 'vue-router';
import routes from './routes';
import store from './store';
import VueCollapse from 'vue2-collapse'
import VModal from 'vue-js-modal'

import 'vue-datetime/dist/vue-datetime.css'
import Toasted from 'vue-toasted';
import Datetime from 'vue-datetime'
import countryCode from './filters/country-code';
import parseDate from './filters/parse-date';
import comma from './filters/comma';
import emptyString from './filters/empty-string';
import lineBreak from './filters/line-break';
import { i18n } from "./i18n";
import PrettyCheck from 'pretty-checkbox-vue/check';



export default class Setup {
    constructor(config) {
        this.config = config;
    }

    start() {
        // Things that needs to be done before we initialize vue.
        this.getAppSettings();
        this.registerVueComponents();
        this.useVueComponents();
        this.registerDirectives();
        this.registerFilters();
        this.registerFilters();

        this.initVue();
    }

    getAppSettings() {
        window.appSettings = require('./../../storage/app/settings');
    }

    initVue() {
        this.store = this.initStore();
        this.router = this.initRouter();

        new Vue({
            el : '#app',
            router : this.router,
            store : this.store,
            i18n,
        });
    }

    initStore() {
        store.commit('setAuthUser', this.config.authUser);

        return store;
    }

    initRouter() {
        return new VueRouter({
            mode : 'history',
            routes
        });
    }

    registerVueComponents() {
        // Menus
        Vue.component('navigation', require('./components/menus/Navigation.vue').default);

        // Forms
        Vue.component('currency-select', require('./components/forms/CurrencySelect.vue').default);
        Vue.component('v-input', require('./components/forms/Input.vue').default);
        Vue.component('v-select', require('./components/forms/Select.vue').default);
        Vue.component('v-datepicker', require('./components/forms/Datepicker.vue').default);
        Vue.component('accordion', require('./components/accordions/Accordion.vue').default);
        Vue.component('form-errors', require('./components/forms/Errors.vue').default);
        Vue.component('uploader', require('./components/forms/Uploader.vue').default);
        Vue.component('p-check', PrettyCheck);

        // Buttons
        Vue.component('link-button', require('./components/buttons/LinkButton.vue').default);
        Vue.component('action-button', require('./components/buttons/ActionButton.vue').default);
        Vue.component('v-button', require('./components/buttons/Button.vue').default);
        Vue.component('back-button', require('./components/buttons/BackButton.vue').default);

        // Sections
        Vue.component('section-title', require('./components/sections/Title.vue').default);
        Vue.component('section-subtitle', require('./components/sections/Subtitle.vue').default);
        Vue.component('v-footer', require('./components/sections/Footer.vue').default);

        // Cards
        Vue.component('basic-card', require('./components/cards/BasicCard.vue').default);

        // Text
        Vue.component('helper-text', require('./components/text/HelperText.vue').default)
        Vue.component('text-link', require('./components/text/TextLink.vue').default)

        // Pages
        Vue.component('page-title', require('./components/pages/Title.vue').default)
        Vue.component('page-subtitle', require('./components/pages/Subtitle.vue').default)

        // Modal
        Vue.component('modal-title', require('./components/modals/Title.vue').default)
        Vue.component('modal-cancel', require('./components/modals/CancelButton.vue').default)

        // Messages
        Vue.component('information', require('./components/messages/Information.vue').default)

        // Misc
        Vue.component('vue-headful', require('vue-headful').default)
    }

    registerDirectives() {

    }

    registerFilters() {
        Vue.filter('parseCountryCode', countryCode);
        Vue.filter('parseDate', parseDate);
        Vue.filter('comma', comma);
        Vue.filter('emptyString', emptyString);
        Vue.filter('lineBreak', lineBreak);
    }

    useVueComponents() {
        Vue.use(VModal);
        Vue.use(VueCollapse);
        Vue.use(VueRouter);
        Vue.use(Datetime);
        Vue.use(Toasted, {
            position: 'top-right',
            duration: 500000,
            keepOnHover: true,
            containerClass: 'fsr-toasted',
            action: {
                text: 'Close',
                onClick: (e, toastObject) => {
                    toastObject.goAway(0);
                }
            }
        });
    }
}
