<template>
  <div class="py-4 text-center">
    <h3 class="font-weight-medium">{{ $t(title) }}</h3>
  </div>
</template>
<script>
export default {
  name: "NotFound",
  props: {
    title: {
      type: String,
      default: "Item not found",
      required: false,
    },
    redirect: {
      type: Boolean,
      default: false,
      required: false,
    },
    redirectBtnLabel: {
      type: String,
      default: "Go to home",
      required: false,
    },
    redirectUrl: {
      type: String,
      required: false,
      default: "/",
    },
    image: {
      type: Boolean,
      required: false,
      default: "/",
    },
  },
};
</script>
