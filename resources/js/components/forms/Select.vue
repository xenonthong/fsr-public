<template>
    <div class="border-3 rounded bg-white px-4 py-2" v-if="options.length > 0">
        <label class="text-sm text-grey">
            {{ $t(label) }}
        </label>
        <div class="relative">
            <select class="block appearance-none w-full bg-white leading-tight text-input focus:outline-none"
                    @change="handleChange"
                    v-model="selected"
            >

                <template v-if="optionIsString()">
                    <option v-for="option in options" :value="option">
                        {{ $t(option) }}
                    </option>
                </template>

                <template v-else>
                    <option v-for="option in options" :value="option.value">
                        {{ $t(option.display) }}
                    </option>
                </template>
            </select>
            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pl-4">
                <img src="/images/arrow-down.svg" alt="downwards arrow">
            </div>
        </div>
    </div>
</template>

<script>
    import { camelCase } from 'lodash';

    export default {
        props : [
            'label',
            'options',
            'selectedOption',
            'translate'
        ],

        data() {
            return {
                selected : this.selectedOption,
            }
        },

        mounted() {
            this.setDefaultSelection();
            this.optionIsString();
        },

        methods : {
            handleChange() {
                this.$emit('selected', this.selected);
            },

            setDefaultSelection() {
                this.selected = this.selectedOption;
                this.$emit('selected', this.selected);
            },

            optionIsString() {
                return typeof this.options[0] === 'string'
            },
        },
    }
</script>