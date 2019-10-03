<template>
    <section class="page_404">
        <div class="container mx-auto">
            <div class="flex">
                <div class="w-full">
                    <div class="w-10/12 mx-auto  text-center">
                        <div class="four_zero_four_bg">
                            <page-title class="text-center">404</page-title>
                        </div>

                        <div class="contant_box_404">
                            <h3 class="h2">
                                {{ $t("Look like you're lost") }}
                            </h3>

                            <p>{{ $t('The page you are looking for not available!') }}</p>

                            <div class="w-full md:w-1/5 mt-6 mx-auto">
                                <link-button :to="{ name: 'home' }">Return home</link-button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
    export default {
        name : "404"
    }
</script>

<style scoped>
    body {
        background-color: #FFFFFF !important;
    }

    .page_404 {
        padding: 40px 0;
    }

    .page_404 img {
        width: 100%;
    }

    .four_zero_four_bg {
        background-image: url(https://cdn.dribbble.com/users/285475/screenshots/2083086/dribbble_1.gif);
        height: 400px;
        background-position: center;
    }


    .four_zero_four_bg h1 {
        font-size: 80px;
    }

    .four_zero_four_bg h3 {
        font-size: 80px;
    }

    .contant_box_404 {
        margin-top: -50px;
    }
</style>