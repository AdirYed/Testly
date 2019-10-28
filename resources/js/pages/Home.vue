<template>
    <div>
        <div id="home-img-section" class="flex flex-column">
            <section id="homepage-img" class="tw-w-full"></section>

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

        <div class="tw-px-2">
            <div id="home-body" class="tw-container tw--mx-2 tw-flex tw-flex-wrap tw-flex-row">
                <div class="tw-w-1/3 tw-px-2">
                    <theory-card class="" src="/assets/action-asphalt.jpg" alt="asphalt.jpg">
                        <template slot="title">This is the title</template>

                        <template slot="description">This is the description</template>
                    </theory-card>
                </div>
                <div class="tw-w-1/3 tw-px-2">
                    <theory-card class="" src="/assets/action-asphalt.jpg" alt="asphalt.jpg">
                        <template slot="title">This is the title</template>

                        <template slot="description">This is the description</template>
                    </theory-card>
                </div>
                <div class="tw-w-1/3 tw-px-2">
                    <theory-card class="" src="/assets/action-asphalt.jpg" alt="asphalt.jpg">
                        <template slot="title">This is the title</template>

                        <template slot="description">This is the description</template>
                    </theory-card>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'home',
    };
</script>
