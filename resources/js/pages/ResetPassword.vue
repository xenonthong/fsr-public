<template>
    <div class="container mx-auto">
        <vue-headful title="Reset password | FSR" />
        <div class="flex">
            <div class="bg-white w-11/12 p-5 mx-auto mt-10 border-2 border-off-white rounded-lg md:w-1/2 lg:w-1/3 md:p-10 md:mt-20">
                <router-link :to="{ name: 'home' }">
                    <img class="mx-auto" src="/images/logo.svg" alt="FSR Holdings logo">
                </router-link>
                <p class="text-sm text-center text-light-grey mb-8 leading-normal">{{ $t('Pay lesser with our competitive exchange rates and say goodbye to costly service fees. Start remitting money with no fuss.') }}</p>
                <div class="mb-12" v-if="hasErrors">
                    <form-errors :errors="errors"/>
                </div>
                <form @submit.prevent="changePassword">
                    <div class="mb-8">
                        <div>
                            <v-input @on-input="(val) => this.email = val"
                                     type="text"
                                     :value="email"
                                     :label="$t('Email')"/>
                        </div>

                        <div class="mt-4">
                            <v-input @on-input="(val) => this.password = val"
                                     type="password"
                                     :value="password"
                                     :label="$t('Password')"/>
                        </div>

                        <div class="mt-4">
                            <v-input @on-input="(val) => this.passwordConfirmation = val"
                                     type="password"
                                     :value="passwordConfirmation"
                                     :label="$t('Repeat password')"/>
                        </div>
                    </div>

                    <v-button size="medium">{{ $t('Change password') }}</v-button>

                    <div class="border-t border-grey-lightest mt-12 mb-8"></div>

                    <p class="leading-normal text-sm">
                        {{ $t('Recalled your password?') }}
                        <router-link class="text-purple text-sm" :to="{ name: 'login' }">
                            {{ $t('Login') }}
                        </router-link>
                    </p>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    import { size } from 'lodash'

    export default {
        data() {
            return {
                email : null,
                password : null,
                passwordConfirmation : null,
                errors : [],
            }
        },

        methods : {
            changePassword() {
                axios.post('/password/reset', {
                    email : this.email,
                    password: this.password,
                    password_confirmation: this.passwordConfirmation,
                    token: this.$route.params.token
                })
                     .then((res) => {
                         this.$router.push({ name: 'home' });
                     })
                     .catch((err) => {
                         this.errors = err.response.data.errors
                     });
            },
        },

        computed : {
            hasErrors() {
                return size(this.errors) > 0;
            }
        }
    }
</script>