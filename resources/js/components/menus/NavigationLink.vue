<template>
    <router-link class="block md:inline-block text-blue-grey no-underline px-3 font-medium" :to="url">
        <slot></slot>
    </router-link>
</template>

<script>
    export default {
        props : ['url']
    }
</script>