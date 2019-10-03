<template>
    <div class="container mx-auto mt-5">
        <basic-card>
            <div class="flex flex-wrap">
                <div class="w-full pb-6 md:w-1/2 md:py-8 md:pr-12 lg:w-7/12 lg:pr-20">
                    <h2 class="text-2xl mb-4">{{ $t('Got questions?') }}</h2>
                    <p class="mb-6">
                        {{ $t("Pay less with our competitive exchange rates and say goodbye to costly service fees. Start remitting money with no fuss.") }}
                    </p>
                    <a class="inline-block bg-purple text-center text-white px-8 py-2 rounded-sm"
                       href="mailto:test@example.com">{{ $t('Drop us an email') }}</a>
                </div>

                <div class="w-full border-t border-off-white pt-3 md:w-1/2 md:py-8 md:pl-12 md:border-t-0 md:border-l lg:w-5/12 lg:pl-20">
                    <h2 class="text-2xl md:mb-4">{{ settings.office_name }}</h2>
                    <p class="whitespace-pre-line" v-html="settings.office_address"></p>
                    <div class="mt-7">
                        <p class="text-sm text-light-grey">{{ $t('Email us') }}</p>
                        <h5 class="text-lg mb-4">{{ settings.email }}</h5>
                        <p class="text-sm text-light-grey">{{ $t('Call us') }}</p>
                        <h5 class="text-lg">{{ settings.office_number }}</h5>
                    </div>
                </div>
            </div>
        </basic-card>
    </div>
</template>

<script>
    export default {
        props : ['benefits'],

        computed : {
            settings() {
                return window.appSettings;
            }
        }
    }
</script>