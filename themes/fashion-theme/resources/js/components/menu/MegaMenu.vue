<template>
  <!-- MegaMenu Wrapper -->
  <div class="mega-menu-wrapper" ref="catDropdown">
    <!-- MegaMenu Button -->
    <button
      class="btn w-100 text-left text-uppercase d-flex align-items-center text-color-white font-weight-medium rounded"
      @click="toggleMegaMenu"
    >
      <base-icon-svg class="mr-15" name="category" :height="5.5" :width="16" />
      {{ $t("All Categories") }}
    </button>
    <!-- End MegaMenu Button -->

    <!-- MegaMenu -->
    <div class="megamenu" :class="{ show: isShow }">
      <div class="megamenu-content">
        <div class="row gx-0 position-relative">
          <div class="cat-dropdown light-bg position-static box-shadow">
            <div class="d-flex justify-content-between">
              <!-- All Categories -->
              <div class="all-category d-flex justify-content-end">
                <router-link to="/categories" class="btn-link custom-menu">{{
                  $t("All Categories")
                }}</router-link>
              </div>
              <!-- End All Categories -->

              <!-- All Categories -->
              <div class="all-category d-flex justify-content-end">
                <router-link to="/products" class="btn-link custom-menu">{{
                  $t("All Products")
                }}</router-link>
              </div>
              <!-- End All Categories -->
            </div>

            <!-- Categories -->
            <ul class="list-unstyled mb-0 categories">
              <li
                v-for="(cat, index) in megaCategories"
                :key="`cat-${index}`"
                class="category-link"
              >
                <router-link
                  :to="`/products/category/${cat.slug}`"
                  class="custom-menu"
                  >{{ cat.name }}</router-link
                >

                <!-- Sub Category Menu -->
                <div v-if="cat.childs.data" class="sub-categories box-shadow">
                  <div class="row gx-0">
                    <div :class="cat.offerInfo ? 'col-lg-10' : 'col-12'">
                      <div class="row">
                        <div
                          v-for="(subCatGroup, i) in cat.childs.data"
                          :key="`subCatGroup-${i}`"
                          class="col-lg-3 mt-2 mb-2"
                        >
                          <!-- Sub Category Group -->
                          <div class="sub-category-group">
                            <h6 class="sub-category-title">
                              <router-link
                                :to="`/products/category/${subCatGroup.slug}`"
                              >
                                {{ subCatGroup.name }}
                              </router-link>
                            </h6>

                            <ul class="sub-category list-unstyled mb-0">
                              <li
                                v-for="(item, j) in subCatGroup.childs.data"
                                :key="`item-${j}`"
                                class="sub-category-link"
                              >
                                <router-link
                                  :to="`/products/category/${item.slug}`"
                                >
                                  {{ item.name }}
                                </router-link>
                              </li>
                            </ul>
                          </div>
                          <!-- End Sub Category Group -->
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- End Sub Category Menu -->
              </li>
            </ul>
            <!-- End Categories -->
          </div>
        </div>
      </div>
    </div>
    <!-- End MegaMenu -->
  </div>
  <!-- End MegaMenu Wrapper -->
</template>

<script>
export default {
  name: "MegaMenu",
  props: {
    megaCategories: {
      type: Array,
      required: true,
    },
  },
  data() {
    return {
      isShow: false,
    };
  },
  mounted() {
    document.addEventListener("click", this.close);
  },
  watch: {
    $route(to, from) {
      this.isShow = false;
    },
  },

  methods: {
    toggleMegaMenu() {
      this.isShow = !this.isShow;
    },
    close(e) {
      let el = this.$refs.catDropdown;
      let target = e.target;
      if (el !== target && !el?.contains(target)) {
        this.isShow = false;
      }
    },
  },
  beforeDestroy() {
    document.removeEventListener("click", this.close);
  },
};
</script>
<style scoped>
.text-color-white {
  color: #fff;
}
</style>
