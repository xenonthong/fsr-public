<template>
    <div @click.prevent="$router.back()" class="text-white border-2 border-purple bg-white text-purple p-3 text-center w-full rounded cursor-pointer">
        <slot></slot>
    </div>
</template>