<template>
    <div class="arrow" :class="arrowClasses">
        <div class="border-3 rounded bg-white p-4" :class="{
                    'border-grey-dark' : !this.isFocused,
                    'border-purple' : this.isFocused
        }">
            <label class="text-sm text-light-grey">
                <slot name="label"></slot>
            </label>
            <input class="w-full text-3xl leading-tight text-input focus:outline-none"
                   :type="type"
                   @focusin="isFocused = true"
                   @focusout="isFocused = false"
                   :value="value"
                   @input="updateValue"
            >
        </div>
    </div>
</template>

<script>
    import { mapState } from 'vuex';

    export default {
        props : [
            'type',
            'arrowDirection',
            'stateName',
        ],

        data() {
            return {
                isFocused : false,
            }
        },

        methods: {
            updateValue(e) {
                if (this.stateName === 'fromAmount') {
                    this.$store.commit(`setConverterFromAmount`, e.target.value);
                } else {
                    this.$store.commit(`setConverterToAmount`, e.target.value);
                }

                this.$emit('on-input', e);
            }
        },

        computed : {
            arrowClasses() {
                let classes = {};

                classes['arrow--' + this.arrowDirection] = this.isFocused;

                return classes;
            },

            ...mapState({
                value(state) {
                    return state.converter[this.stateName]
                }
            })
        }
    }
</script>

<style scoped>
    .arrow {
        transition: padding .3s cubic-bezier(0.5, 0.25, 0, 1);;
        background-repeat: no-repeat;
    }

    .arrow--down {
        padding-bottom: 3.5rem;
        background-image: url('/images/calculator/arrow-down.svg');
        background-position: center 80px;
    }

    .arrow--up {
        padding-top: 3.5rem;
        background-image: url('/images/calculator/arrow-up.svg');
        background-position: center 10px;
    }

    label {
        color: #929AAA;
    }
</style>