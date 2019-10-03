<template>
    <div>
        <vue-headful title="My account | FSR" />
        <navigation/>
        <account-details :account="account" v-if="account" @account-updated="getAccount"/>
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
                account : null
            }
        },

        mounted() {
            this.getAccount();
        },

        methods : {
            getAccount() {
                axios.get('/me')
                     .then((r) => {
                         this.account = r.data.account;
                     })
            }
        }
    }
</script>