<template>
  <li class="tw-my-1">
    <router-link
      :to="{ name: to, params: toParams, hash: toHash }"
      class="tw-text-white tw-font-bold tw-text-3xl tw-border-b-2 tw-border-transparent active:tw-border-white"
    >
      <slot></slot>
    </router-link>
  </li>
</template>

<script>
export default {
  name: "burger-bar",

  props: {
    to: {
      type: String,
      required: false
    },

    toParams: {
      type: Object,
      default: () => {
        return {};
      }
    },

    toHash: {
      required: false,
      type: String
    }
  }
};
</script>

<style scoped>
.active\:tw-border-white:active {
  @apply tw-border-white;
}
</style>
