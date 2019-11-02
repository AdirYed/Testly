<template>
    <div class="tw-container tw-mx-auto" style="max-width: 740px; padding: 2rem 2.5rem">
        <h1 class="tw-text-3xl tw-font-bold">
            שגיאה 404
        </h1>

        <p class="tw-border-r-2 tw-border-primary tw-pr-2 tw-my-6">
            נראה שהגעת לקישור שלא קיים.
        </p>

        <router-link class="tw-text-primary tw-font-bold" :to="{ name: 'home' }">
            אל דף הבית.
        </router-link>
    </div>
</template>

<script>
    export default {
        name: 'notFound',
    }
</script>
