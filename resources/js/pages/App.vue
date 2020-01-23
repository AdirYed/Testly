<template>
    <div>
        <testly-header />

        <router-view
            :key="$route.fullPath"
            class="container tw-pb-8 md:tw-pb-10"
        />

        <testly-footer />
    </div>
</template>

<script>
export default {
    name: "app"
};
</script>
