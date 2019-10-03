<template>
    <button class="text-white bg-purple border-2 border-purple px-3 text-center w-full block rounded" :class="buttonSize">
        <slot></slot>
    </button>
</template>

<script>
    export default {
        props : ['size'],

        computed : {
            buttonSize() {
                let classes;

                switch (this.size) {
                    case 'medium':
                        classes = {
                            'py-3' : true,
                            'text-xl' : true,
                        };

                        break;

                    case 'large':
                        classes = {
                            'py-4' : true,
                            'text-2xl' : true,
                        };

                        break;

                    default:
                        classes = {
                            'py-3' : true
                        };
                }

                return classes;
            }
        }
    }
</script>