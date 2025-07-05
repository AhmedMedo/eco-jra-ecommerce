<template>
  <router-link class="brand-card" :to="`/products/brand/${brand.permalink}`">
    <v-lazy-image :src="`${brand.logo}`" :alt="brand.name" />
  </router-link>
</template>

<script>
import VLazyImage from "v-lazy-image";
export default {
  name: "BrandCard",
  components: {
    "v-lazy-image": VLazyImage,
  },
  props: {
    brand: {
      type: Object,
      required: true,
    },
  },
};
</script>

<style lang="scss" scoped>
@import "../../assets/sass/00-abstracts/01-variables";
.brand-card {
  color: #3b3b3b;
  text-decoration: none;
  background-color: transparent;
  img {
    padding: 0px;
    margin-right: 0px;
    min-width: 80px;
    height: 82px;
    margin-bottom: 20px;
    -o-object-fit: cover;
    object-fit: cover;
  }
  span {
    font-size: 16px;
    font-weight: 500;
  }
  @media (max-width: 480px) {
    padding: 10px;
    img {
      margin-right: 0px;
      min-width: 40px;
      height: 40px;
    }
    span {
      font-size: 14px;
    }
  }
}
</style>
