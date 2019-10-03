<template>
    <div class="accordion border-off-white p-4">
        <div class="cursor-pointer no-underline flex justify-between" @click.prevent="active = !active">
            <slot name="header"></slot>
            <span class="self-center" v-show="!active">
                <svg fill="#AEBDCF" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                    <path d="M5 3h14a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5c0-1.1.9-2 2-2zm0 2v14h14V5H5zm8 6h2a1 1 0 0 1 0 2h-2v2a1 1 0 0 1-2 0v-2H9a1 1 0 0 1 0-2h2V9a1 1 0 0 1 2 0v2z"/>
                </svg>
            </span>
            <span class="self-center" v-show="active">
                <svg fill="#AEBDCF" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                    <path d="M5 3h14a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5c0-1.1.9-2 2-2zm0 2v14h14V5H5zm11 7a1 1 0 0 1-1 1H9a1 1 0 0 1 0-2h6a1 1 0 0 1 1 1z"/>
                </svg>
            </span>
        </div>
        <div class="pt-2" v-show="active">
            <slot name="content"></slot>
        </div>
    </div>
</template>

<script>
    export default {
        props : ['title'],

        data() {
            return {
                active : false,
            }
        }
    }
</script>

<style>
    .accordion + .accordion {
        border-top-width: 2px;
    }
</style>