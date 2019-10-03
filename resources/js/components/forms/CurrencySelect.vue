<template>
    <div class="border-3 rounded bg-white" :class="paddingSize" v-if="options.length > 0">
        <label class="text-sm text-grey">
            {{ label }}
        </label>

        <div class="relative">
            <select class="block appearance-none w-full bg-white leading-tight text-input focus:outline-none"
                    @change="handleChange"
                    v-model="selected"
            >
                <option v-for="option in options"
                        :value="option"
                >{{ option }}
                </option>
            </select>
            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pl-4">
                <img src="/images/arrow-down.svg" alt="downwards arrow">
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props : ['options', 'selectedOption', 'label'],

        data() {
            return {
                selected : this.selectedOption
            }
        },

        mounted() {
            this.setDefaultSelection();
        },

        methods : {
            handleChange() {
                this.$emit('selected', this.selected);
            },

            setDefaultSelection() {
                this.selected = this.selectedOption;
                this.$emit('selected', this.selected);
            }
        },

        computed : {
            paddingSize() {
                return {
                    'px-4' : this.label,
                    'py-2' : this.label,
                    'p-4' : !this.label,
                }
            }
        }
    }
</script>