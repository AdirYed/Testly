<template>
    <div class="max-w-full max-h-screen">
        <section id="homepage-img" class="w-full absolute top-0 left-0 block"></section>

        <div id="products-wrapper" class="absolute flex">
            <h1 style="font-size: 50px">test</h1>
        </div>

        // Color will be changed when we have 2 primary colors
        <button class="btn-scroll-down absolute btn bg-red-500 hover:bg-blue-700 text-white rounded">
            קרא/י עוד
        </button>
    </div>
</template>

<script>
    export default {
        name: 'home',
    };
</script>
