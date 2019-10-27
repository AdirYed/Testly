<template>
    <div>
        <div id="home-img-section" class="max-w-full max-h-screen">
            <section id="homepage-img" class="w-full absolute top-0 left-0 block"></section>

            <div id="products-wrapper" class="absolute flex"> <!-- TODO: wrap between the two divs and show 2 products we give in the site  -->
                <div>
                    <h1>test</h1>
                </div>

                <div>
                    <h1>Second test</h1>
                </div>
            </div>

            <!-- TODO: scroll down in js -->
            <button class="btn-scroll-down absolute btn bg-transparent border-2 border-primary hover:bg-primary text-primary hover:text-white rounded">
                קרא/י עוד
            </button>
        </div>

        <div id="home-body" class="flex text-center">
            <theory-card src="/storage/assets/action-asphalt.jpg">
                <template slot="title">This is the title</template>

                <template slot="description">This is the description</template>
            </theory-card>
            <theory-card src="/storage/assets/action-asphalt.jpg">
                <template slot="title">This is the title</template>

                <template slot="description">This is the description</template>
            </theory-card>
            <theory-card src="/storage/assets/action-asphalt.jpg">
                <template slot="title">This is the title</template>

                <template slot="description">This is the description</template>
            </theory-card>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'home',
    };
</script>
