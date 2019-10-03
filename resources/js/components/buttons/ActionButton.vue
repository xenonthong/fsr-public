<template>
    <div @click="$emit('click')" class="block text-white border-2 border-purple bg-purple p-3 text-center w-full rounded cursor-pointer">
        <slot></slot>
    </div>
</template>