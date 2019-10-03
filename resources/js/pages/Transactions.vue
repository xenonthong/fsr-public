<template>
    <div>
        <vue-headful title="Your transactions | FSR"/>
        <navigation/>
        <div class="container mx-auto">

            <div class="-mt-4 md:hidden lg:hidden">
                <accordion>
                    <template #header>
                        <h3 class="md:text-2xl">Filters</h3>
                    </template>

                    <template #content>
                        <div class="mb-5">
                            <div class="flex flex-wrap -mx-2">
                                <div class="w-1/2 px-2">
                                    <v-datepicker @on-input="(val) => createdFrom = val"
                                                  :value="createdFrom"
                                                  :label="$t('From')"/>
                                </div>

                                <div class="w-1/2 px-2">
                                    <v-datepicker @on-input="(val) => createdTo = val"
                                                  :value="createdTo"
                                                  :label="$t('To')"/>
                                </div>

                                <div class="w-full px-2 mt-2">
                                    <v-select :label="$t('Sort by')"
                                              :selected-option="sortOptions[0].value"
                                              :options="sortOptions"
                                              @selected="(val) => sort = val"
                                              v-if="sortOptions.length > 0">
                                    </v-select>
                                </div>

                                <div class="w-full px-2 mt-2">
                                    <action-button @click="getTransactions">Search</action-button>
                                </div>
                            </div>
                        </div>
                    </template>
                </accordion>
            </div>

            <basic-card>
                <div class="flex flex-wrap mb-3">
                    <div class="w-full md:w-7/12">
                        <page-title>{{ $t('Past transactions') }}</page-title>
                    </div>
                </div>

                <div class="hidden md:block lg:block mb-10 mt-5">
                    <div class="flex flex-wrap -mx-2">
                        <div class="w-1/4 px-2">
                            <v-datepicker @on-input="(val) => createdFrom = val"
                                          :value="createdFrom"
                                          :label="$t('From')"/>
                        </div>

                        <div class="w-1/4 px-2">
                            <v-datepicker @on-input="(val) => createdTo = val"
                                          :value="createdTo"
                                          :label="$t('To')"/>
                        </div>

                        <div class="w-1/4 px-2">
                            <v-select :label="$t('Sort by')"
                                      :selected-option="sortOptions[0].value"
                                      :options="sortOptions"
                                      @selected="(val) => sort = val"
                                      v-if="sortOptions.length > 0">
                            </v-select>
                        </div>

                        <div class="w-1/4 px-2 self-center">
                            <action-button @click="getTransactions">{{ $t('Search') }}</action-button>
                        </div>
                    </div>
                </div>

                <div class="-mx-6 md:hidden lg:hidden" v-if="transactions.length > 0">
                    <div class="w-full md:w-7/12">
                        <div class="px-6">
                            <div v-for="(transaction, key) in transactions">
                                <div v-if="shouldDisplayDate(key)"
                                     class="transaction-date -mx-6 px-6 border-b-2 border-off-white bg-off-white py-2 text-grey">
                                    {{ transaction.transaction_date }}
                                </div>
                                <div class="border-t border-grey-lightest py-4">
                                    <h5 class="font-medium uppercase text-blue-grey">{{ transaction.beneficiary.name }}</h5>
                                    <div class="text-xs text-light-grey">
                                        {{ $t('Txn') }} #{{ transaction.id }} -
                                        <span class="capitalize text-light-grey">{{ transaction.status }}</span>
                                    </div>
                                    <div class="pt-3">
                                        <span class="leading-none text-xs text-light-grey">
                                            {{ transaction.from_currency }}
                                        </span>
                                        <span class="leading-none text-sm font-medium">
                                            {{ transaction.from_amount }}
                                        </span>
                                        <span class="leading-none text-xs text-light-grey">
                                            -
                                        </span>
                                        <span class="leading-none text-xs text-light-grey">
                                            {{ transaction.to_currency }}
                                        </span>
                                        <span class="leading-none text-sm font-medium">
                                            {{ transaction.to_amount }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <table class="hidden md:table lg:table table-auto w-full" v-if="transactions.length > 0">
                    <thead class="text-blue-grey text-left border-b-2 border-purple">
                    <tr>
                        <th class="font-normal pb-5 px-2 capitalize">{{ $t('Txn') }}</th>
                        <th class="font-normal pb-5 px-2">{{ $t('Date') }}</th>
                        <th class="font-normal pb-5 px-2">{{ $t('Name') }}</th>
                        <th class="font-normal pb-5 px-2">{{ $t('From currency') }}</th>
                        <th class="font-normal pb-5 px-2">{{ $t('To currency') }}</th>
                        <th class="font-normal pb-5 px-2">{{ $t('Status') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    <router-link v-for="transaction in transactions"
                                 :key="transaction.id"
                                 class="hover:bg-off-white cursor-pointer"
                                 tag="tr"
                                 :to="{
                                    name: 'transactionDetail',
                                    params: {
                                        id: transaction.id
                                    }
                                 }">
                        <td class="py-3 px-2">{{ transaction.id }}</td>
                        <td class="py-3 px-2">{{ transaction.transaction_date }}</td>
                        <td class="py-3 px-2 uppercase">{{ transaction.beneficiary.name }}</td>
                        <td class="py-3 px-2">
                            <span class="leading-none text-sm text-light-grey">{{ transaction.from_currency }}</span> {{ transaction.from_amount }}
                        </td>
                        <td class="py-3 px-2">
                            <span class="leading-none text-sm text-light-grey">{{ transaction.to_currency }}</span> {{ transaction.to_amount }}
                        </td>
                        <td class="py-3 px-2 capitalize">{{ $t(transaction.status) }}</td>
                    </router-link>
                    </tbody>
                </table>

                <div v-else>
                    <p>Looks like you don't have any transactions yet.</p>
                </div>

                <div v-if="transactions.length > 0" class="text-center mt-5">
                    <span class="inline-block px-3 md:px-5 py-2 font-medium cursor-pointer"
                          :class="firstPageClasses"
                          @click="getPrevPage">
                        Prev
                    </span>
                    <span class="inline-block text-light-grey">{{ currentPage }}</span>
                    <span class="inline-block text-light-grey px-1 md:px-2">of</span>
                    <span class="inline-block text-light-grey">{{ totalPage }}</span>
                    <span class="inline-block px-3 md:px-5 py-3 font-medium cursor-pointer"
                          :class="lastPageClasses"
                          @click="getNextPage">
                        Next
                    </span>
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
    import Help from "../components/sections/Help";

    export default {
        components : {
            Help
        },

        data() {
            return {
                currentPage : null,
                totalPage : null,
                createdFrom : null,
                createdTo : null,
                sort : null,
                sortOptions : [
                    {
                        display : 'Newest',
                        value : 'desc'
                    },
                    {
                        display : 'Oldest',
                        value : 'asc'
                    }
                ],
                transactions : [],
            }
        },

        mounted() {
            this.getTransactions(1);
        },

        methods : {
            getTransactions(page) {
                axios.get('/transactions', {
                    params : {
                        page,
                        createdFrom : this.createdFrom,
                        createdTo : this.createdTo,
                        sort : this.sort,
                    }
                })
                     .then((r) => {
                         this.currentPage = r.data.current_page;
                         this.totalPage = r.data.last_page;
                         this.transactions = r.data.data;
                     })
                     .catch((err) => {
                         this.$toasted.error('Unable to retrieve transactions.')
                     })
            },

            getNextPage() {
                if (this.currentPage === this.totalPage) return;

                this.getTransactions(this.currentPage + 1)
            },

            getPrevPage() {
                if (this.currentPage === 1) return;

                this.getTransactions(this.currentPage - 1)
            },

            /**
             * Checks if its the first transaction or if the dates are different
             * between the current looped transaction  and the previous transaction.
             *
             * @param key
             */
            shouldDisplayDate(key) {
                return key === 0 ||
                    this.transactions[key].transaction_date !== this.transactions[key - 1].transaction_date
            }
        },

        computed : {
            lastPageClasses() {
                if (this.currentPage === this.totalPage) {
                    return {
                        'text-light-grey' : true,
                        'text-purple' : false
                    }
                }

                return {
                    'text-purple' : true,
                    'text-light-grey' : false
                }
            },

            firstPageClasses() {
                if (this.currentPage === 1) {
                    return {
                        'text-light-grey' : true,
                        'text-purple' : false
                    }
                }

                return {
                    'text-purple' : true,
                    'text-light-grey' : false
                }
            }
        }
    }
</script>

<style scoped>
    .transaction-date + .border-t {
        border: 0;
    }
</style>