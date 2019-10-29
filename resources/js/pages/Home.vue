<template>
    <div>
        <!-- TODO: make it responsive -->
        <div id="home-img-section" class="tw-flex tw-flex-wrap tw-flex-col tw-items-center tw-justify-end">
                <div id="products-wrapper" class="tw-flex tw-flex-wrap tw-flex-row">
                    <div id="wrap-left" class="">
                        <h1>test</h1>
                    </div>
                </div>

            <!-- TODO: scroll down in js -->
            <div id="home-btn" class="tw-flex">
                <button class="btn-scroll-down btn tw-bg-transparent tw-border-2 tw-border-primary hover:tw-bg-primary tw-text-primary hover:tw-text-white tw-rounded">
                    קרא/י עוד
                </button>
            </div>
        </div>

        <!-- TODO: make it responsive -->
        <!-- TODO: read more gonna be here -->

        <!-- responsive V -->
        <div id="home-body" class="tw-container tw-flex tw-flex-wrap tw--mx-2 tw-my-2 md:tw--mx-4 md:tw-my-4 lg:tw--mx-6 lg:tw-my-6">
            <div class="tw-flex tw-justify-center tw-items-start tw-p-2 md:tw-p-4 lg:tw-p-6 tw-w-full md:tw-w-1/2 lg:tw-w-1/3">
                <theory-card src="/assets/action-asphalt.jpg" alt="asphalt.jpg">
                    <template slot="title">This is the title</template>

                    <template slot="description">This is the description</template>
                </theory-card>
            </div>
            <div class="tw-flex tw-justify-center tw-items-start tw-p-2 md:tw-p-4 lg:tw-p-6 tw-w-full md:tw-w-1/2 lg:tw-w-1/3">
                <theory-card src="/assets/action-asphalt.jpg" alt="asphalt.jpg">
                    <template slot="title">This is the title</template>

                    <template slot="description">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium aliquam, amet assumenda cum dolorem esse ex ipsam mollitia nesciunt quae sed sunt voluptate! Consectetur ex necessitatibus obcaecati. Dolores, maxime ut?</template>
                </theory-card>
            </div>
            <div class="tw-flex tw-justify-center tw-items-start tw-p-2 md:tw-p-4 lg:tw-p-6 tw-w-full md:tw-w-1/2 lg:tw-w-1/3">
                <theory-card src="/assets/action-asphalt.jpg" alt="asphalt.jpg">
                    <template slot="title">This is the title</template>

                    <template slot="description">This is the description</template>
                </theory-card>
            </div>
            <div class="tw-flex tw-justify-center tw-items-start tw-p-2 md:tw-p-4 lg:tw-p-6 tw-w-full md:tw-w-1/2 lg:tw-w-1/3">
                <theory-card src="/assets/action-asphalt.jpg" alt="asphalt.jpg">
                    <template slot="title">This is the title</template>

                    <template slot="description">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium aliquam, amet assumenda cum dolorem esse ex ipsam mollitia nesciunt quae sed sunt voluptate! Consectetur ex necessitatibus obcaecati. Dolores, maxime ut?</template>
                </theory-card>
            </div>
            <div class="tw-flex tw-justify-center tw-items-start tw-p-2 md:tw-p-4 lg:tw-p-6 tw-w-full md:tw-w-1/2 lg:tw-w-1/3">
                <theory-card src="/assets/action-asphalt.jpg" alt="asphalt.jpg">
                    <template slot="title">This is the title</template>

                    <template slot="description">This is the description</template>
                </theory-card>
            </div>
            <div class="tw-flex tw-justify-center tw-items-start tw-p-2 md:tw-p-4 lg:tw-p-6 tw-w-full md:tw-w-1/2 lg:tw-w-1/3">
                <theory-card src="/assets/action-asphalt.jpg" alt="asphalt.jpg">
                    <template slot="title">This is the title</template>

                    <template slot="description">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium aliquam, amet assumenda cum dolorem esse ex ipsam mollitia nesciunt quae sed sunt voluptate! Consectetur ex necessitatibus obcaecati. Dolores, maxime ut?</template>
                </theory-card>
            </div>
            <div class="tw-flex tw-justify-center tw-items-start tw-p-2 md:tw-p-4 lg:tw-p-6 tw-w-full md:tw-w-1/2 lg:tw-w-1/3">
                <theory-card src="/assets/action-asphalt.jpg" alt="asphalt.jpg">
                    <template slot="title">This is the title</template>

                    <template slot="description">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium aliquam, amet assumenda cum dolorem esse ex ipsam mollitia nesciunt quae sed sunt voluptate! Consectetur ex necessitatibus obcaecati. Dolores, maxime ut?</template>
                </theory-card>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'home',
    };
</script>
