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

        <!-- TODO: read more gonna be here -->

        <!-- TODO: responsive -->
        <div id="home-body" class="tw-container tw-flex tw-flex-wrap tw--mx-2 tw-my-2 md:tw--mx-4 md:tw-my-4 lg:tw--mx-6 lg:tw-my-6">
            <div class="tw-p-2 md:tw-p-4 lg:tw-p-6 md:tw-w-1/2 lg:tw-w-1/3">
                <theory-card src="/assets/action-asphalt.jpg" alt="asphalt.jpg">
                    <template slot="title">This is the title</template>

                    <template slot="description">This is the description</template>
                </theory-card>
            </div>
            <div class="tw-p-2 md:tw-p-4 lg:tw-p-6 md:tw-w-1/2 lg:tw-w-1/3">
                <theory-card src="/assets/action-asphalt.jpg" alt="asphalt.jpg">
                    <template slot="title">This is the title</template>

                    <template slot="description">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium animi, minima natus nesciunt officiis recusandae rem repudiandae? Ab adipisci, aperiam aspernatur autem corporis libero nesciunt quas quo rem sapiente sint!</template>
                </theory-card>
            </div>
            <div class="tw-p-2 md:tw-p-4 lg:tw-p-6 md:tw-w-1/2 lg:tw-w-1/3">
                <theory-card src="/assets/asphalt.jpg" alt="asphalt.jpg">
                    <template slot="title">This is the title</template>

                    <template slot="description">This is the description</template>
                </theory-card>
            </div>
            <div class="tw-p-2 md:tw-p-4 lg:tw-p-6 md:tw-w-1/2 lg:tw-w-1/3">
                <theory-card src="/assets/action-asphalt.jpg" alt="asphalt.jpg">
                    <template slot="title">This is the title</template>

                    <template slot="description">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium animi, minima natus nesciunt officiis recusandae rem repudiandae? Ab adipisci, aperiam aspernatur autem corporis libero nesciunt quas quo rem sapiente sint!</template>
                </theory-card>
            </div>
            <div class="tw-p-2 md:tw-p-4 lg:tw-p-6 md:tw-w-1/2 lg:tw-w-1/3">
                <theory-card src="/assets/asphalt.jpg" alt="asphalt.jpg">
                    <template slot="title">This is the title</template>

                    <template slot="description">This is the description</template>
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
