<template>
    <div class="bg-white py-20">
        <div class="container mx-auto">
            <section-title>{{ $t('Partners') }}</section-title>
            <section-subtitle>
                {{ $t("We've teamed up with fast-growing businesses and agencies to bring out the best of their brands.") }}
            </section-subtitle>
            <div class="flex flex-wrap">
                <div class="m-10 md:m-0 md:p-2 w-full md:w-1/5 self-center" v-for="partner in partners">
                    <img class="m-auto" :src="partner">
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        computed : {
            partners() {
                return [
                    'images/partners/moneygram.svg',
                    'images/partners/bca.svg',
                    'images/partners/sacombank.svg',
                    'images/partners/postal-savings.svg',
                    'images/partners/landbank.svg',
                ]
            }
        }
    }
</script>