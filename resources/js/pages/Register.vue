<template>
    <div class="container mx-auto">
        <vue-headful title="Register | FSR" />
        <div class="flex">
            <div class="bg-white w-11/12 p-5 mx-auto mt-10 border-2 border-off-white rounded-lg md:w-1/2 lg:w-1/3 md:p-10 md:mt-20">
                <router-link :to="{ name: 'home' }">
                    <img class="mx-auto" src="/images/logo.svg" alt="FSR Holdings logo">
                </router-link>
                <p class="text-sm text-center text-light-grey mb-8 leading-normal">{{ $t('Pay lesser with our competitive exchange rates and say goodbye to costly service fees. Start remitting money with no fuss.') }}</p>
                <div class="mb-12" v-if="hasErrors">
                    <form-errors :errors="errors"/>
                </div>
                <form @submit.prevent="register">
                    <div class="mb-4">
                        <v-input @on-input="(val) => this.first_name = val"
                                 type="text"
                                 :value="first_name"
                                 :label="$t('First name')"/>
                    </div>

                    <div class="mb-4">
                        <v-input @on-input="(val) => this.last_name = val"
                                 type="text"
                                 :value="last_name"
                                 :label="$t('Last name')"/>
                    </div>

                    <div class="mb-4">
                        <v-input @on-input="(val) => this.email = val"
                                 type="email"
                                 :value="email"
                                 :label="$t('Email')"/>
                    </div>

                    <div class="mb-4">
                        <v-input @on-input="(val) => this.password = val"
                                 type="password"
                                 :value="password"
                                 :label="$t('Password')"/>
                    </div>

                    <div class="mb-8">
                        <v-input @on-input="(val) => this.referral_code = val"
                                 type="text"
                                 :value="referral_code"
                                 :label="$t('Referral code')"/>
                    </div>

                    <v-button size="medium">{{ $t('Register') }}</v-button>

                    <p class="pt-5 leading-normal text-sm">
                        {{ $t("By signing up, You will be agreeing to our") }}
                        <router-link class="text-purple" to="{name: 'tnc'}">{{ $t('Terms of Use') }}.</router-link>
                    </p>

                    <div class="border-t border-grey-lightest mt-12 mb-8"></div>

                    <p class="leading-normal text-sm">{{ $t('Have an account?') }}
                        <router-link class="text-purple" to="/login">{{ $t('Login') }}</router-link>
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
                first_name : null,
                last_name : null,
                email : null,
                password : null,
                referral_code: null,
                errors: [],
            }
        },

        methods : {
            register() {
                axios.post('/register', {
                    first_name : this.first_name,
                    last_name : this.last_name,
                    email : this.email,
                    password : this.password,
                    referral_code: this.referral_code
                })
                     .then((res) => {
                         this.$store.commit('setAuthUser', res.data.user);

                         this.$router.push(res.data.intended);
                     })
                    .catch((err) => {
                        this.errors = err.response.data.errors
                    });
            },
        },

        computed: {
            hasErrors () {
                return size(this.errors) > 0;
            }
        }
    }
</script>