<template>
    <div class="px-10" v-if="selected">
        <v-collapse-wrapper class="md:hidden">
            <div class="text-blue-grey cursor-pointer font-medium uppercase" v-collapse-toggle>
                <i class="mr-1 -mt-1 dropdown-arrow border-grey-dark down align-middle"></i>
                {{ selected.shortcode }}
            </div>
            <ul class="-mb-2" v-collapse-content>
                <li
                    class="text-blue-grey cursor-pointer font-medium my-2 text-sm"
                    @click="select(language)"
                    v-for="(language, key) in languages">
                    {{ language.name }}
                </li>
            </ul>
        </v-collapse-wrapper>

        <div class="hidden md:block text-blue-grey cursor-pointer font-medium relative"
             @click="showOptions = !showOptions">
            {{ $t('Language') }} ({{ selected.shortcode }})
            <i class="ml-1 -mt-1 dropdown-arrow border-grey-dark down align-middle"></i>

            <div class="nav-bubble absolute w-full z-50" v-show="showOptions" style="top: 40px;">
                <ul class="text-left">
                    <li
                        class="text-blue-grey cursor-pointer font-medium mb-4"
                        @click="select(language)"
                        v-for="(language, key) in languages">
                        {{ language.name }}
                    </li>
                </ul>
            </div>
        </div>
    </div>
</template>

<script>
    import {find} from 'lodash'

    export default {
        data : () => ({
            showOptions : false,
            languages : [
                {
                    name : 'English',
                    shortcode : 'en',
                    locale: 'en'
                },
                {
                    name : 'Japanese',
                    shortcode : 'jp',
                    locale: 'ja'
                },
                {
                    name : 'Chinese',
                    shortcode : 'cn',
                    locale: 'zh_CN',
                }
            ],
            selected : null,
        }),

        created() {
            this.selected = this.initDefault();
        },

        methods: {
            select(language) {
                this.selected = language;
                this.$i18n.locale = language.locale;
            },

            initDefault() {

                return find(this.languages, ['locale', this.$i18n.locale]);
            }
        }
    }
</script>

<style lang="scss">
    .nav-bubble li:last-of-type {
        margin-bottom: 0;
    }
</style>
