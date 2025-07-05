<template>
  <!-- Header Middle -->
  <div
    :class="
      headerStyle.custom_header == 1
        ? 'custom-header-mid header-middle header-top pt-3'
        : 'header-middle header-top pt-3'
    "
  >
    <div class="custom-container2">
      <div class="row align-items-center">
        <!--Site Brand-->
        <div class="col-lg-3">
          <template v-if="mode == 'dark'">
            <the-logo
              :header-logo-style="headerLogoStyle"
              :logo="siteProperties.logo_dark"
              :title="siteProperties.site_name"
              v-if="siteProperties.logo_dark"
            />
            <h2 class="site-title mb-0" v-else>
              <a href="/">{{ siteProperties.site_name }}</a>
            </h2>
          </template>
          <template v-else>
            <the-logo
              :header-logo-style="headerLogoStyle"
              :logo="siteProperties.logo"
              :title="siteProperties.site_name"
              v-if="siteProperties.logo"
            />
            <h2 class="site-title mb-0" v-else>
              <a href="/">{{ siteProperties.site_name }}</a>
            </h2>
          </template>
        </div>
        <!--End Site Brand-->
        <div
          class="col-lg-8 align-items-center d-flex justify-content-end position-static"
        >
          <!-- Menu -->
          <div v-if="dataLoading">
            <ul class="nav-horizontal desktop">
              <li v-for="(item, index) in menuSkeletons" :key="index">
                <skeleton height="12px" border-radius="10px" :width="item">
                </skeleton>
              </li>
            </ul>
          </div>

          <HorizontalMenu
            v-if="!dataLoading"
            :menu-items="menuItems"
            :header-menu-style="headerMenuStyle"
          />
          <!-- End Menu -->
        </div>

        <div class="col-lg-1 d-flex justify-content-end">
          <div class="header-info-wrap">
            <ul class="list-unstyled header-info">
              <li>
                <div
                  class="lang-currency-wrap"
                  ref="languageDropdownMenu"
                  v-if="!dataLoading"
                >
                  <div
                    class="lang-currency"
                    @click.prevent="
                      showLanguageCurrency = !showLanguageCurrency
                    "
                  >
                    <div>
                      <span class="text-uppercase custom-menu">{{
                        $i18n.locale
                      }}</span>
                      <span v-if="selected_currency" class="custom-menu">{{
                        selected_currency.code
                      }}</span>
                    </div>
                    <span class="material-icons ms-1">expand_more</span>
                  </div>
                  <div
                    class="lang-currency-dropdown"
                    v-if="showLanguageCurrency"
                  >
                    <ul class="list-unstyled">
                      <li>
                        <span>{{ $t("Language") }}</span>
                        <select
                          class="theme-input-style"
                          v-model="selected_lang"
                        >
                          <option
                            v-for="(lang, index) in languages"
                            :key="index"
                            :value="lang.code"
                          >
                            {{ lang.title }}
                          </option>
                        </select>
                      </li>
                      <li>
                        <span>{{ $t("Currency") }}</span>
                        <select
                          class="theme-input-style"
                          v-model="selected_currency"
                        >
                          <option
                            v-for="(currency, index) in currencies"
                            :key="index"
                            :value="currency"
                          >
                            {{ currency.code }}
                          </option>
                        </select>
                      </li>
                      <li class="w-100">
                        <button
                          type="button"
                          class="btn btn_fill w-100 justify-content-center custom-lang-switch-btn"
                          @click.prevent="setCurrencyLanguage"
                        >
                          {{ $t("Save Changes") }}
                        </button>
                      </li>
                    </ul>
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- End Header Middle -->
</template>
<script>
import MenuDropdown from "../../components/menu/MenuDropdown.vue";
import HorizontalMenu from "@/components/menu/HorizontalMenu.vue";
export default {
  name: "HeaderMiddle",
  components: {
    HorizontalMenu,
    MenuDropdown,
  },
  emits: ["change-language-currency-country"],
  props: {
    siteProperties: {
      type: Object,
      required: false,
    },
    currencies: {
      type: Array,
      required: false,
      default: () => {
        return [];
      },
    },
    languages: {
      type: Array,
      required: false,
      default: () => {
        return [];
      },
    },
    mode: {
      type: String,
      required: false,
    },
    headerStyle: {
      type: Object,
      required: false,
      default: () => {
        return {};
      },
    },
    headerLogoStyle: {
      type: Object,
      required: false,
      default: () => {
        return {};
      },
    },
    menuItems: {
      type: Array,
      required: false,
      default: () => {
        return [];
      },
    },
    dataLoading: {
      type: Boolean,
      required: true,
      default: false,
    },
  },
  data() {
    return {
      loading: false,
      menuSkeletons: ["100px", "70px", "130px", "90px", "100px"],
      selected_lang: localStorage.getItem("locale") || "en",
      selected_currency: JSON.parse(localStorage.getItem("currency")),
      showLanguageCurrency: false,
    };
  },
  mounted() {
    if (this.suggestionsOpen) {
      window.addEventListener("click", (e) => {
        if (!this.$el.contains(e.target)) {
          this.suggestionsOpen = false;
        }
      });
    }

    window.addEventListener("scroll", this.scrollHandler);
    document.addEventListener("click", this.close);
  },

  methods: {
    /**
     * Will close dropdown area
     *
     * @param {*} e
     */
    close(e) {
      let el2 = this.$refs.languageDropdownMenu;
      let target = e.target;

      if (el2 !== target && !el2?.contains(target)) {
        this.showLanguageCurrency = false;
      }
    },
    /**
     * Change currency , Language and country
     */
    setCurrencyLanguage() {
      this.$emit(
        "change-language-currency",
        this.selected_lang,
        this.selected_currency
      );
    },
  },
};
</script>

<style lang="scss" scoped>
.site-title a {
  color: #000;
}
.text-color-white {
  color: #fff;
}
</style>