<template>
    <div class="border-2 rounded bg-off-white px-4 py-2">
        <label class="text-sm text-grey">
            {{ label }}
        </label>
        <p class="text-dark-grey capitalize text-lg md:text-2xl">
            <slot/>
        </p>
    </div>
</template>

<script>
    export default {
        props : [
            'label'
        ]
    }
</script>