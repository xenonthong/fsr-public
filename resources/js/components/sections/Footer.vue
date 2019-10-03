<template>
    <footer class="bg-white px-4 py-8">
        <div class="container mx-auto">
            <div class="flex flex-wrap">
                <router-link :to="{ name: 'home' }" class="mb-8 w-full md:w-1/2 lg:w-3/12">
                    <img src="/images/logo-grey.svg" alt="fsr logo">
                </router-link>

                <div class="w-full md:w-1/2 lg:w-3/12">
                    <p class="text-lightest-grey mb-3">{{ $t('Information') }}</p>
                    <ul class="mb-8 text-blue-grey md:mb-10 capitalize">
                        <li class="mb-3">
                            <router-link class="hover:text-purple" :to="{ name: 'policy' }">{{ $t('Policy') }}</router-link>
                        </li>
                        <li class="mb-3">
                            <router-link class="hover:text-purple" :to="{ name: 'tnc' }">{{ $t('T&Cs') }}</router-link>
                        </li>
                        <li class="mb-3">
                            <router-link class="hover:text-purple" :to="{ name: 'faq' }">{{ $t('FAQ') }}</router-link>
                        </li>
                    </ul>
                    <ul class="text-blue-grey" v-if="!$store.getters.isAuthenticated">
                        <li class="mb-3">
                            <router-link class="hover:text-purple" :to="{ name: 'login' }">{{ $t('Login') }}</router-link>
                        </li>
                        <li class="mb-3">
                            <router-link class="hover:text-purple" :to="{ name: 'register' }">{{ $t('Register') }}</router-link>
                        </li>
                    </ul>
                </div>

                <div class="w-full lg:w-6/12">
                    <p class="text-lightest-grey mb-3 mt-16 md:mt-0">{{ $t('License') }}</p>
                    <p class="text-blue-grey mb-10">
                        {{ $t("We are licensed by the Financial Services Agency (金融庁 Kin'yū-chō, FSA) is a Japanese government agency and an integrated financial regulator responsible for overseeing banking, securities and exchange, and insurance sectors in order to ensure the stability of the financial system of Japan. The agency operates with a Commissioner and reports to the Minister of State for Financial Services. It oversees the Securities and Exchange Surveillance Commission and the Certified Public Accountants and Auditing Oversight Board.") }}
                    </p>
                </div>
            </div>

            <p class="leading-none text-lightest-grey">{{ year }} FSR-Holdings. {{ $t('All Rights Reserved') }}.</p>
        </div>
    </footer>
</template>

<script>
    export default {
        name : "Footer",

        computed : {
            year() {
                return (new Date()).getFullYear()
            }
        }
    }
</script>

<style scoped>

</style>