<template>
    <div>
        <vue-headful title="Home | FSR" />
        <navigation />
        <home-hero />
        <benefits :benefits="benefits" />
        <partners />
        <contact />
        <v-footer />
    </div>
</template>

<script>
import HomeHero from "./../components/heroes/HomeHero";
import Benefits from "../components/sections/Benefits";
import Partners from "../components/sections/Partners";
import Contact from "../components/sections/Contact";

export default {
    components: {
        Contact,
        Partners,
        Benefits,
        HomeHero
    },

    mounted() {
        this.getOngoingPromo();
    },

    methods: {
        getOngoingPromo() {
            axios.get("/latest-promotion").then(r => {
                console.log(r.data.promotion);

                if (r.data.promotion) {
                    this.$toasted.info(r.data.promotion.message);

                    console.log(r.data.promotion);
                }
            });
        }
    },

    computed: {
        benefits() {
            return [
                {
                    icon: "/images/benefits/arrows.svg",
                    title: "Receive funds within 10 minutes"
                },
                {
                    icon: "/images/benefits/hands.svg",
                    title: "Always get our rate&nbsp;guarantee"
                },
                {
                    icon: "/images/benefits/globe.svg",
                    title: "Remit to and from most&nbsp;countries"
                }
            ];
        }
    }
};
</script>
