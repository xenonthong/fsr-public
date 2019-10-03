<template>
    <div class="px-3">
        <v-collapse-wrapper class="md:hidden">
            <div class="text-blue-grey cursor-pointer font-medium" v-collapse-toggle>
                <i class="mr-1 -mt-1 dropdown-arrow border-grey-dark down align-middle"></i>
                {{ authUser.name }}
            </div>
            <ul class="-mb-2" v-collapse-content>
                <li class="text-blue-grey cursor-pointer font-medium my-2 -mx-2 text-sm">
                    <navigation-link url="/account">{{ $t('My account') }}</navigation-link>
                </li>
                <li class="text-blue-grey cursor-pointer font-medium my-2 -mx-2 text-sm">
                    <navigation-link url="/me/beneficiaries">{{ $t('Remit') }}</navigation-link>
                </li>
                <li class="text-blue-grey cursor-pointer font-medium my-2 -mx-2 text-sm" v-if="authUser.verification_status !== 'verified'">
                    <navigation-link url="/verification">{{ $t('Verification') }}</navigation-link>
                </li>
                <li class="text-blue-grey cursor-pointer font-medium my-2 -mx-2 text-sm">
                    <navigation-link url="/me/transactions">{{ $t('Transactions') }}</navigation-link>
                </li>
            </ul>
        </v-collapse-wrapper>

        <div class="hidden md:block text-blue-grey cursor-pointer font-medium relative text-right"
             @click="showOptions = !showOptions">
            {{ authUser.name }}
            <i class="ml-1 -mt-1 dropdown-arrow border-grey-dark down align-middle"></i>

            <div class="nav-bubble absolute z-50" v-show="showOptions" style="top: 40px; width: 200px">
                <ul class="text-left">
                    <li class="mb-4">
                        <navigation-link url="/account">{{ $t('My account') }}</navigation-link>
                    </li>
                    <li class="mb-4">
                        <navigation-link url="/me/beneficiaries">{{ $t('Remit') }}</navigation-link>
                    </li>
                    <li class="mb-4" v-if="authUser.verification_status !== 'verified'">
                        <navigation-link url="/verification">{{ $t('Verification') }}</navigation-link>
                    </li>
                    <li class="mb-4">
                        <navigation-link url="/me/transactions">{{ $t('Transactions') }}</navigation-link>
                    </li>
                    <li class="mb-4">
                        <a class="block md:inline-block text-blue-grey no-underline px-3 font-medium" @click.prevent="logout">{{ $t('Logout') }}</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</template>

<script>
    import { mapGetters } from 'vuex'
    import NavigationLink from "./NavigationLink";

    export default {
        components : {NavigationLink},
        computed : {
            ...mapGetters([
                'authUser',
            ])
        },
        data() {
            return {
                showOptions: false,
            }
        },
        methods: {
            logout() {
                axios.post('/logout')
                    .then(() => {
                        window.location = '/';
                    });
            }
        }
    }
</script>
