<template>
    <div class="border-3 rounded bg-white px-4 py-2"
         :class="{
                    'border-grey-dark' : !this.isFocused,
                    'border-purple' : this.isFocused
        }">
        <label class="text-sm text-grey">
            {{ label }}
        </label>
        <div>
            <datetime
                    v-model="date"
                    @input="onInput"
                    value-zone="local"
                    zone="local"
                    @focus="isFocused = true"
                    @close="isFocused = false"
                    input-class="w-full leading-tight text-input focus:outline-none">
            </datetime>
        </div>
    </div>
</template>

<script>

    export default {
        props : [
            'type',
            'label',
            'value',
        ],

        data() {
            return {
                isFocused : false,
                date : null,
            }
        },

        methods : {
            onInput(date) {
                if (date) this.$emit('on-input', this.getDate(date));
            },

            getDate(date) {
                return date.split('T')[0]
            }
        },

        mounted() {
            this.date = this.value;
        }
    }
</script>

<style lang="scss">
    .vdatetime-popup__header,
    .vdatetime-calendar__month__day--selected > span > span,
    .vdatetime-calendar__month__day--selected:hover > span > span {
        background: #5D76F8;
    }

    .vdatetime-month-picker__item--selected,
    .vdatetime-popup__actions__button {
        color: #5D76F8
    }
</style>