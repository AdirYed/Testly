<template>
    <header id="nav-bar" class="tw-min-w-full tw-bg-white tw-flex tw-flex-wrap tw-items-center lg:tw-py-0 tw-py-2 lg:tw-px-16 tw-px-6 tw-sticky tw-top-0 tw-left-0">
        <div class="tw-hidden tw-flex-1 lg:tw-flex tw-justify-between tw-items-center">
            <ul class="lg:tw-flex tw-items-center tw-justify-between tw-text-base tw-text-gray-700 tw-pt-4 lg:tw-pt-0">
                <slot name="left-bar"></slot>
            </ul>
        </div>

        <label for="menu-toggle" class="tw-pointer-cursor lg:tw-hidden block"><svg class="tw-fill-current tw-text-gray-900" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"><title>menu</title><path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"></path></svg></label>
        <input class="tw-hidden" type="checkbox" id="menu-toggle" />

        <div class="tw-hidden lg:tw-flex lg:tw-items-center lg:tw-w-auto tw-w-full" id="menu">
            <nav>
                <ul class="lg:tw-flex tw-items-center tw-justify-between tw-text-base tw-text-gray-700 tw-pt-4 lg:tw-pt-0">
                    <slot name="right-bar"></slot>
                </ul>
            </nav>

            <a href="#" class="lg:tw-ml-4 tw-flex tw-items-center tw-justify-start lg:tw-mb-0 tw-mb-4 tw-pointer-cursor">
                <img class="tw-rounded-full tw-w-10 tw-h-10 tw-border-2 tw-border-transparent" src="https://pbs.twimg.com/profile_images/1128143121475342337/e8tkhRaz_normal.jpg" alt="Andy Leverenz">
            </a>
        </div>
    </header>
</template>

<script>
    export default {
        name: 'nav-bar',

        props: {
            src: {
                type: String,
                require: true,
            },
        },
    };
</script>
