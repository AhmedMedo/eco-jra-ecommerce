<template>
  <!-- Banners -->
  <section class="brand-slider-section home-page-section">
    <div class="px-3 px-sm-0">
      <swiper
        v-if="properties.brands.length && properties.style == 'slider'"
        :direction="'horizontal'"
        :slidesPerView="'auto'"
        :modules="modules"
        :centeredSlides="true"
        :rtl="true"
        :loop="true"
        :autoplay="{
          delay: 2000,
          disableOnInteraction: false,
          pauseOnMouseEnter: true,
        }"
        @onSlideChange="onSlideChange"
        class="mySwiper brand-slider brand-full-width theme-slider-dots"
        :breakpoints="{
          '0': {
            slidesPerView: 2,
            loop: true,
          },
          '768': {
            slidesPerView: 5,
            loop: true,
          },
          '1024': {
            slidesPerView: 7,
            loop: true,
          },
          '1440': {
            slidesPerView: 7,
            loop: true,
          },
        }"
      >
        <swiper-slide
          v-for="(brand, index) in properties.brands"
          :key="`brand-${index}`"
        >
          <brand-card :brand="brand" />
        </swiper-slide>
      </swiper>
      <div class="row" v-else>
        <div
          v-for="(brand, index) in properties.brands"
          :key="`brand-${index}`"
          class="col-6 col-sm-6 col-md-4 col-lg-3 col-xl-2"
        >
          <brand-card :brand="brand" />
        </div>
      </div>
    </div>
  </section>
  <!-- End Categories -->
</template>

<script>
import { defineAsyncComponent } from "vue";
import { Swiper, SwiperSlide } from "swiper/vue";
const BrandCard = defineAsyncComponent(() => import("../../ui/BrandCard.vue"));

import { Autoplay, Pagination } from "swiper/modules";

export default {
  name: "BrandSlider",
  components: {
    BrandCard,
    Swiper,
    SwiperSlide,
  },
  setup() {
    return {
      modules: [Autoplay, Pagination],
    };
  },
  props: {
    properties: {
      type: Object,
      default: {},
    },
  },
  methods: {
    onSlideChange(swiper) {
      if (swiper.activeIndex === swiper.slides.length - 1) {
        swiper.slideTo(0);
      }
    },
  },
};
</script>
