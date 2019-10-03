<template>
    <div class="container mx-auto">
        <div class="py-20">
            <section-title>
                {{ $t("We're a worldwide presence") }}
            </section-title>

            <div class="lg:w-6/12 mx-auto">
                <section-subtitle>
                    {{ $t("Find us in various locations around the globe. You can find below some of our offices.") }}
                </section-subtitle>
            </div>

            <div class="flex flex-wrap -mx-4 md:w-4/5 lg:w-7/12 md:mx-auto">
                <template v-for="(store, key) in stores">
                    <div class="w-full md:w-1/2 mb-5 md:p-4 rounded-lg" v-if="key === 0">
                        <location-card :title="store.name"
                                       :flag="store.address.country | parseCountryCode"
                                       main-location="true">
                            <div class="mb-8">
                                {{ store.address.line_1 }}<br>
                                {{ store.address.line_2 }}<br>
                                {{ store.address.country | parseCountryCode }}{{ store.address.city | comma }}{{ store.address.postal_code | comma }}
                            </div>

                            <div>
                                <span class="text-sm text-light-grey">Email us</span>
                                <br><span class="text-lg text-dark-blue inline-block -mt-1">{{ settings.email }}</span>
                            </div>
                        </location-card>
                    </div>

                    <div class="w-full md:w-1/2 mb-5 md:p-4 rounded-lg" v-else-if="key === 1 || key === 2">
                        <location-card :title="store.name"
                                       :flag="store.address.country | parseCountryCode"
                                       main-location="false">
                            {{ store.address.line_1 }}<br>
                            {{ store.address.line_2 }}<br>
                            {{ store.address.country | parseCountryCode }}{{ store.address.city | comma }}{{ store.address.postal_code | comma }}
                        </location-card>
                    </div>

                    <div class="w-full md:w-1/3 mb-5 md:p-4 rounded-lg" v-else>
                        <location-card :title="store.name"
                                       :flag="store.address.country | parseCountryCode"
                                       main-location="false">
                            {{ store.address.line_1 }}<br>
                            {{ store.address.line_2 }}<br>
                            {{ store.address.country | parseCountryCode }}{{ store.address.city | comma }}{{ store.address.postal_code | comma }}
                        </location-card>
                    </div>
                </template>
            </div>
        </div>
    </div>
</template>

<script>
    import LocationCard from "../cards/LocationCard";
    import settings from '../../../../storage/app/settings';

    export default {
        components : {LocationCard},
        data() {
            return {
                stores : [],
                settings,
            }
        },

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
        },
        methods : {
            getStores() {
                axios.get(`/api/${apiVersion}/stores`)
                     .then(r => this.stores = r.data)
            },
        },

        mounted() {
            this.getStores();
        }
    }
</script>