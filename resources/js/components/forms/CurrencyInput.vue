<template>
    <div class="border-3 rounded bg-white px-4 py-2" :class="{
                    'border-grey-dark' : !this.isFocused,
                    'border-purple' : this.isFocused
        }">
        <label class="text-sm text-grey">
            {{ label }}
        </label>
        <input class="w-full leading-tight text-input focus:outline-none"
               :value="value"
               @focusin="isFocused = true"
               @focusout="isFocused = false"
               @input="updateValue"
        >
    </div>
</template>

<script>
    import { mapState } from 'vuex';

    export default {
        props : [
            'label',
            'stateName',
        ],

        data() {
            return {
                isFocused : false,
            }
        },

        methods : {
            updateValue(e) {
                if (this.stateName === 'fromAmount') {
                    this.$store.commit(`setConverterFromAmount`, e.target.value);
                }
                else {
                    this.$store.commit(`setConverterToAmount`, e.target.value);
                }

                this.$emit('on-input', e);
            }
        },

        computed : {
            ...mapState({
                value(state) {
                    return state.converter[this.stateName]
                }
            })
        }
    }
</script>