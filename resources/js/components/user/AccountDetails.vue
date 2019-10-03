<template>
    <div class="container mx-auto">
        <basic-card>
            <div class="flex flex-wrap mb-5">
                <div class="w-full md:w-1/2">
                    <p class="text-sm text-light-grey">{{ $t('Member since') }} {{ account.created_at | parseDate }}</p>
                    <page-title>{{ account.name }}</page-title>
                </div>
                <div class="w-full mt-6 md:w-1/2 md:mt-0 md:self-center">
                    <div class="md:w-3/4 md:ml-auto">
                        <a class="inline-block text-center text-white px-6 py-2 rounded md:py-3 md:block"
                           :class="disabledPurpleButton"
                           @click="inEditingMode(true)">
                            {{ $t('Edit') }} {{ $t('Profile') }}
                        </a>
                    </div>
                </div>
            </div>
            <div class="flex flex-wrap">
                <div class="w-full md:w-1/2">
                    <div class="md:w-3/4">
                        <helper-text>{{ $t('Personal details') }}</helper-text>
                        <div class="mb-2 md:mb-5">
                            <displayable-field :label="$t('Date of birth')" v-if="!is_editing">
                                {{ account.profile.dob | parseDate | emptyString }}
                            </displayable-field>
                            <v-datepicker v-else
                                          @on-input="(val) => this.form.dob = val"
                                          :value="form.dob"
                                          :label="$t('Date of birth')"/>
                        </div>
                        <div class="mb-2 md:mb-5">
                            <displayable-field :label="$t('Contact number')" v-if="!is_editing">
                                {{ account.profile.contact_number | emptyString }}
                            </displayable-field>
                            <v-input v-else
                                     @on-input="(val) => this.form.contact_number = val"
                                     type="number"
                                     :value="form.contact_number"
                                     :label="$t('Contact number')"/>
                        </div>
                        <div class="mb-2 md:mb-5">
                            <displayable-field :label="$t('Nationality')" v-if="!is_editing">
                                {{ account.profile.nationality | emptyString }}
                            </displayable-field>
                            <v-input v-else
                                     @on-input="(val) => this.form.nationality = val"
                                     type="text"
                                     :value="form.nationality"
                                     :label="$t('Nationality')"/>
                        </div>
                        <div class="mb-2 md:mb-5">
                            <displayable-field :label="$t('Address')" v-if="!is_editing">
                                <div v-if="hasAddress" class="leading-snug text-base mt-3">
                                    <div>{{ account.profile.address.line_1 }}</div>
                                    <div>{{ account.profile.address.line_2 }}</div>
                                    <div>{{ account.profile.address.country }}</div>
                                    <div>{{ account.profile.address.state }}</div>
                                    <div>{{ account.profile.address.city }}</div>
                                    <div>{{ account.profile.address.postal_code }}</div>
                                </div>
                                <div v-else>
                                    -
                                </div>
                            </displayable-field>

                            <div v-else>
                                <div class="mb-2 md:mb-5">
                                    <v-input @on-input="(val) => this.form.line_1 = val"
                                             type="text"
                                             :value="form.line_1"
                                             :label="$t('Address line 1')"/>
                                </div>
                                <div class="mb-2 md:mb-5">
                                    <v-input @on-input="(val) => this.form.line_2 = val"
                                             type="text"
                                             :value="form.line_2"
                                             :label="$t('Address line 2')"/>
                                </div>
                                <div class="mb-2 md:mb-5">
                                    <v-input @on-input="(val) => this.form.country = val"
                                             type="text"
                                             :value="form.country"
                                             :label="$t('Country')"/>
                                </div>
                                <div class="mb-2 md:mb-5">
                                    <v-input @on-input="(val) => this.form.state = val"
                                             type="text"
                                             :value="form.state"
                                             :label="$t('State')"/>
                                </div>
                                <div class="mb-2 md:mb-5">
                                    <v-input @on-input="(val) => this.form.city = val"
                                             type="text"
                                             :value="form.city"
                                             :label="$t('City')"/>
                                </div>
                                <div class="mb-2 md:mb-5">
                                    <v-input @on-input="(val) => this.form.postal_code = val"
                                             type="text"
                                             :value="form.postal_code"
                                             :label="$t('Postoal code')"/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="w-full mt-5 md:w-1/2 md:mt-0">
                    <div class="md:w-3/4 md:ml-auto">
                        <helper-text>{{ $t('Account details') }}</helper-text>
                        <div class="mb-2 md:mb-5">
                            <displayable-field :label="$t('Referral code')">
                                {{ account.referral_code | emptyString}}
                            </displayable-field>
                        </div>
                        <div class="mb-2 md:mb-5">
                            <displayable-field :label="$t('Points earned')">
                                0
                            </displayable-field>
                        </div>
                        <div class="mb-2 md:mb-5">
                            <displayable-field :label="$t('Verification')">
                                {{ $t(account.verification_status) }}
                            </displayable-field>
                        </div>
                        <div v-if="isUnverified && !is_editing">
                            <a class="inline-block text-center text-white px-6 py-2 rounded md:py-3 md:block bg-purple"
                               href="#"
                               @click.prevent="submitVerification()">
                                {{ $t('Get verified') }}
                            </a>
                        </div>
                        <div class="mt-3 md:mt-5">
                            <form-errors :errors="errors"/>
                        </div>
                        <div class="flex mt-6 md:mt-10" v-if="is_editing">
                            <a href="#"
                               @click.prevent="clear()"
                               class="flex-1 rounded text-center bg-white text-purple px-6 py-2 ml-2">
                                {{ $t('Cancel') }}
                            </a>
                            <a href="#"
                               @click.prevent="save()"
                               class="flex-1 rounded text-center text-white bg-purple px-6 py-2 ml-2">
                                {{ $t('Save') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </basic-card>
    </div>
</template>

<script>
    import DisplayableField from '../forms/DisplayableField';
    import moment from 'moment';

    export default {
        components : {DisplayableField},
        props : ['account'],

        data : () => ({
            is_editing : false,
            form : {
                dob : '',
                contact_number : '',
                nationality : '',
                line_1 : '',
                line_2 : '',
                country : '',
                state : '',
                city : '',
                postal_code : '',
            },
            errors : [],
        }),

        created() {
            this.getFormDefaultValues();
        },

        methods : {
            inEditingMode(edit) {
                this.is_editing = edit;
            },

            save() {
                axios.put('/me', this.form)
                     .then((r) => {
                         this.errors = [];

                         this.$toasted.success(r.data);
                         this.inEditingMode(false);
                         this.$emit('account-updated');
                     })
                     .catch((err) => {
                         this.errors = err.response.data.errors
                     });
            },

            getFormDefaultValues() {
                this.form.dob = moment().format('YYYY-MM-DD');

                if (this.account.profile.dob) {
                    console.log(this.account.profile.dob.split(" ")[0]);
                    this.form.dob = this.account.profile.dob.split(" ")[0];
                }

                this.form.contact_number = this.account.profile.contact_number;
                this.form.nationality = this.account.profile.nationality;
                this.form.line_1 = this.account.profile.address.line_1;
                this.form.line_2 = this.account.profile.address.line_2;
                this.form.country = this.account.profile.address.country;
                this.form.state = this.account.profile.address.state;
                this.form.city = this.account.profile.address.city;
                this.form.postal_code = this.account.profile.address.postal_code;
            },

            submitVerification() {
                axios.post('/verification', this.form)
                     .then((r) => {
                         this.$toasted.success(r.data);
                         this.$emit('account-updated');
                     })
                     .catch((err) => {
                         if (err.response.status === 403) {
                             this.$toasted.error('Please ensure that your personal details has been filled up before submitting a verification request.');
                         }
                     });
            },

            clear() {
                this.inEditingMode(false);
                this.getFormDefaultValues();
            }
        },

        computed : {
            disabledPurpleButton() {
                return {
                    'bg-purple' : !this.is_editing,
                    'bg-light-purple' : this.is_editing,
                    'cursor-not-allowed' : this.is_editing,
                }
            },

            isUnverified() {
                return this.account.verification_status === 'unverified'
            },

            hasAddress() {
                // Need to filter off addressable_id and addressable_type to consider it as a
                // valid address as these are returned as defaults because of 'withDefaults()'
                return Object.keys(this.account.profile.address).length > 2;
            }
        }
    }
</script>