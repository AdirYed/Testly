<template>
  <header
    class="tw-min-w-full tw-bg-white tw-flex tw-flex-wrap tw-shadow-lg tw-items-center tw-py-0 lg:tw-px-16 lg:tw-px-24 tw-px-3 tw-fixed tw-top-0"
    id="nav-bar"
  >
    <div
      class="tw-hidden tw-flex-1 lg:tw-flex tw-justify-between tw-items-center"
    >
      <ul
        class="lg:tw-flex tw-items-center tw-justify-between tw-text-base tw-text-gray-700 tw-pt-4 lg:tw-pt-0"
      >
        <slot name="left-bar" />
      </ul>
    </div>

    <div
      class="tw-hidden lg:tw-flex lg:tw-items-center lg:tw-w-auto tw-w-full"
      id="menu"
    >
      <nav>
        <ul
          class="lg:tw-flex tw-items-center tw-justify-between tw-text-base tw-text-gray-700 tw-pt-4 lg:tw-pt-0"
        >
          <slot name="right-bar" />
        </ul>
      </nav>
    </div>

    <burger-menu></burger-menu>
  </header>
</template>

<script>
import BurgerMenu from "./BurgerMenu";

export default {
  name: "nav-bar",

  components: {
    BurgerMenu
  }
};
</script>
