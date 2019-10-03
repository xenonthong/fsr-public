<template>
    <div class="container mx-auto">
        <div class="flex flex-wrap md:py-5 lg:py-10 md:mb-16 lg:mb-32">
            <div class="md:w-1/2 lg:w-5/12 lg:ml-auto lg:mr-20 md:mt-10">
                <h1 class="text-5xl font-medium leading-tight mb-5">{{ $t('Save more when sending money overseas.') }}</h1>
                <p>{{ $t('Pay lesser with our competitive exchange rates and say goodbye to costly service fees. Start remitting money with no fuss.') }}</p>
            </div>
            <div class="md:w-1/2 lg:w-4/12 lg:mr-auto -mx-4 md:mx-0">
                <div class="mt-10 md:mt-0 md:ml-5 lg:ml-0"><currency-calculator/>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import CurrencyCalculator from './CurrencyCalculator';

    export default {
        components : {
            CurrencyCalculator
        }
    }
</script>

<style scoped>

</style>