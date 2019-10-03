<template>
    <div class="border-3 rounded bg-white px-4 py-2" :class="{
                    'border-grey-dark' : !this.isFocused,
                    'border-purple' : this.isFocused
        }">
        <label class="text-sm text-grey">
            {{ label }}
        </label>
        <input class="w-full leading-tight text-input focus:outline-none"
               :type="type"
               :value="value"
               @focusin="isFocused = true"
               @focusout="isFocused = false"
               @input="onInput"
        />
    </div>
</template>

<script>
    export default {
        props: [
            'type',
            'label',
            'value'
        ],

        data() {
            return {
                isFocused: false,
            }
        },

        methods: {
            onInput(e) {
                this.$emit('on-input', e.target.value);
            }
        },
    }
</script>