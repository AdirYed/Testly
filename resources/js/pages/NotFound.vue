<template>
  <div
    class="tw-container tw-mx-auto"
    style="max-width: 740px; padding: 2rem 2.5rem"
  >
    <vue-headful
      description="טסטלי מבחני תאוריה. האתר מספק סימולציית מבחני תאוריה לכל הרישיונות באופן חדשני, מקצועי, איכותי וחינמי! שגיאה 404."
      title="טסטלי - מבחני תאוריה - שגיאה 404"
    />

    <h1 class="tw-text-3xl tw-font-bold">
      שגיאה 404
    </h1>

    <p class="tw-border-r-2 tw-border-primary tw-pr-2 tw-my-6">
      נראה שהגעת לקישור שלא קיים.
    </p>

    <router-link :to="{ name: 'home' }" class="link tw-font-bold">
      אל דף הבית.
    </router-link>
  </div>
</template>

<script>
export default {
  name: "not-found"
};
</script>
