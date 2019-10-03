<template>
    <div class="border-l-4 border-red p-4" role="alert" v-if="hasErrors()">
        <h5 class="font-medium">{{ $t('The given data was invalid') }}</h5>
        <ul class="list-disc ml-5 text-sm">
            <li class="mt-1" v-for="error in validationErrors">{{ $t(error) }}</li>
        </ul>
    </div>
</template>

<script>
    import { size } from 'lodash';

    export default {
        props : ['errors'],

        methods: {
            hasErrors() {
                return size(this.errors) > 0;
            }
        },

        computed : {
            validationErrors() {
                let errors = Object.values(this.errors);

                return errors.flat();
            }
        },
    }
</script>