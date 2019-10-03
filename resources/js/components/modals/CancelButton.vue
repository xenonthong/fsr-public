<template>
    <div @click.prevent="$modal.hide(modalName)" class="text-white border-2 border-purple bg-white text-purple p-3 text-center w-full rounded cursor-pointer">
        <slot></slot>
    </div>
</template>

<script>
    export default {
        props: ['modalName']
    }
</script>