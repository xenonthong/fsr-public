<template>
    <router-link class="text-white bg-purple p-3 text-center w-full block rounded"
                 :to="to"
                 :class="fontSize"
    >
        <slot></slot>
    </router-link>
</template>

<script>
    export default {
        props: ['to', 'size'],

        computed: {
            fontSize() {
                if (!this.size) return {};

                let classes = {};

                classes[`text-${this.size}`] = true;

                return classes;
            }
        }
    }
</script>