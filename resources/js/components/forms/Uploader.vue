<template>
    <!--    TODO: Fix bug whereby user is able to upload another file extension even though our settings prevented them to. -->
    <!-- Step 1: Upload a non-image -->
    <!-- Step 2: Select another image after an alert warning pops-up -->
    <!-- Step 3: Submit form -->
    <input type="file" name="files" @change="fileSelected">
</template>

<script>
    import './../../../libraries/fileuploader/jquery.fileuploader.css';
    import './../../../libraries/fileuploader/jquery.fileuploader.js';

    export default {
        props: ['options'],

        mounted() {
            let options = {};

            if (this.options) options = this.options;
            jQuery(this.$el).fileuploader(options)
        },

        methods: {
           fileSelected(event) {
                this.$emit('file-selected', event.target.files);
           }
        }
    }
</script>