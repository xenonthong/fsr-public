<template>
    <div class="container mx-auto">
        <div class="border-off-white border-t md:border-0 flex flex-wrap -mx-4 md:mb-20">
            <div class="w-full md:w-2/3 lg:w-1/3 md:px-3 md:mb-5 lg:mb-0" v-for="(benefit, key) in benefits">
                <div class="bg-white px-8 py-12 border-b border-off-white md:rounded-lg md:border-2 border-off-white">
                    <div class="mb-12">
                        <img style="height: 65px" :src="benefit.icon">
                    </div>
                    <h2 class="text-4xl font-medium leading-tight mb-5">{{ $t(`home.benefits.${key + 1}`) }}</h2>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props : ['benefits']
    }
</script>