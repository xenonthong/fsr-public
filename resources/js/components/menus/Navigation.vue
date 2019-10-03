<template>
    <div class="container mx-auto">
        <nav class="relative">
            <div class="py-3 flex flex-wrap">
                <!-- Logo -->
                <router-link :to="{ name: 'home' }" class="-mb-1 w-7/12 md:w-1/3 lg:w-1/2">
                    <img src="/images/logo.svg" alt="logo">
                </router-link>

                <div class="w-5/12 md:w-2/3 lg:w-1/2 self-center">
                    <div class="md:bg-transparent absolute md:static top-0 right-0 w-3/4 md:w-full pt-6 md:pt-0 pr-5 md:pr-0 text-right md:text-left -mr-4 md:mr-0 z-50"
                         :class="{ 'menu-opened bg-white' : menuIsOpened  }">
                        <!-- Hamburger -->
                        <div class="md:hidden">
                            <button class="object-right hamburger hamburger--squeeze"
                                    :class="{ 'is-active' : menuIsOpened  }"
                                    type="button"
                                    @click=" menuIsOpened = !menuIsOpened">
                                <span class="hamburger-box">
                                    <span class="hamburger-inner"></span>
                                </span>
                            </button>
                        </div>
                        <ul class="md:flex md:flex-wrap flex-row-reverse" :class="{ hidden : !menuIsOpened }">
                            <li class="my-6 md:my-0"
                                v-if="$store.getters.isAuthenticated">
                                <navigation-greeting/>
                            </li>
                            <li class="my-6 md:my-0" v-if="!$store.getters.isAuthenticated">
                                <navigation-link :url="{ name: 'register' }">{{ $t('Register') }}</navigation-link>
                            </li>
                            <li class="my-6 md:my-0" v-if="!$store.getters.isAuthenticated">
                                <navigation-link :url="{ name: 'login' }">{{ $t('Login') }}</navigation-link>
                            </li>
                            <li class="my-6 md:my-0 md:order-last">
                                <navigation-link :url="{ name: 'faq' }">{{ $t('Help') }}</navigation-link>
                            </li>
                            <li class="my-6 md:my-0 order-last md:order-4 md:text-center">
                                <navigation-language/>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
    </div>
</template>

<script>
    import NavigationLink from './NavigationLink';
    import NavigationLanguage from './NavigationLanguage';
    import NavigationGreeting from './NavigationGreeting';

    export default {
        components : {
            NavigationLanguage,
            NavigationLink,
            NavigationGreeting,
        },
        data() {
            return {
                menuIsOpened : false,
            }
        }
    }
</script>

<style>
    .menu-opened {
        min-height: 100vh;
    }
</style>
