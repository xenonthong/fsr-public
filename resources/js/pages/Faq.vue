<template>
    <div>
        <vue-headful title="Frequently Asked Questions | FSR" />
        <navigation/>
        <div class="container mx-auto">
            <basic-card>
                <div class="mb-3">
                    <page-title>{{ $t('FAQ') }}</page-title>
                </div>

                <div class="-mx-4">
                    <accordion v-for="faq in faqs" :key="faq.id">
                        <template #header>
                            <h3 class="md:text-2xl capitalize">{{ faq.question }}</h3>
                        </template>

                        <template #content>
                            <p class="leading-snug">{{ faq.answer }}</p>
                        </template>
                    </accordion>
                </div>
            </basic-card>
        </div>
        <help/>
        <div class="mt-20">
            <v-footer/>
        </div>
    </div>
</template>

<script>
    import AccountDetails from "../components/user/AccountDetails";
    import Help from "../components/sections/Help";

    export default {
        components : {
            AccountDetails,
            Help
        },

        data() {
            return {
                faqs : null
            }
        },

        mounted() {
            this.getFaqs();
        },

        methods : {
            getFaqs() {
                axios.get('/faqs')
                     .then((r) => {
                         this.faqs = r.data.faqs;
                     })
            }
        }
    }
</script>