import Vue from 'vue';
import VueI18n from 'vue-i18n'
import zh_CN from './locale/zh_CN.json';
import en from './locale/en.json';
import ja from './locale/ja.json';

Vue.use(VueI18n);

export const i18n = new VueI18n({
    locale : 'en',
    fallbackLocale : 'en',
    messages : {zh_CN, en, ja}
});