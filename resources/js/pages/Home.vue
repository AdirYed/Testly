<template>
    <div>
        <div id="home-img-section" class="tw-w-full tw-h-screen flex flex-column">
            <section id="homepage-img" class="tw-w-full tw-block"></section>

            <!-- TODO: wrap between the two divs and show 2 products we give in the site -->
            <div id="products-wrapper" class="tw-absolute tw-flex">
                <div>
                    <h1>test</h1>
                </div>

                <div>
                    <h1>Second test</h1>
                </div>
            </div>

            <!-- TODO: scroll down in js -->
            <button class="btn-scroll-down tw-absolute btn tw-bg-transparent tw-border-2 tw-border-primary hover:tw-bg-primary tw-text-primary hover:tw-text-white tw-rounded">
                קרא/י עוד
            </button>
        </div>

        <div id="home-body" class="tw-flex tw-flex-column">
            <theory-card src="/assets/action-asphalt.jpg">
                <template slot="title">This is the title</template>

                <template slot="description">This is the description</template>
            </theory-card>
            <theory-card src="/assets/action-asphalt.jpg">
                <template slot="title">This is the title</template>

                <template slot="description">This is the description</template>
            </theory-card>
            <theory-card src="/assets/action-asphalt.jpg">
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
