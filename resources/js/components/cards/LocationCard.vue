<template>
    <div class="bg-white p-6">
        <div class="mb-6">
            <img v-if="flag" :src="flagIcon" width="48px">
        </div>

        <h2 class="font-medium leading-tight mb-5" :class="titleClasses">
            {{ title }}
        </h2>

        <p class="text-lg leading-relaxed mb-5 text-blue-grey">
            <slot></slot>
        </p>
    </div>
</template>

<script>
    export default {
        props : [
            'title',
            'mainLocation',
            'flag'
        ],

        computed : {
            titleClasses : function () {
                return {
                    'text-5xl' : this.mainLocation === 'true',
                    'text-3xl' : this.mainLocation !== 'true',
                }
            },

            flagIcon() {
                return `/images/flags/${this.flag}.svg`;
            }
        },

        name : "LocationCard"
    }
</script>

<style scoped>

</style>