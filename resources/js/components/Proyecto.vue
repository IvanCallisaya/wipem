<template>
  <div>
    <div class="container">
      <div class="heading-3 gap-50">
        <h5 class="text-center text-uppercase">{{ proyecto.nombre }}</h5>
      </div>

      <div class="row justify-content-md-center">
        <div class="col-md-12 col-lg-12">
          <div class="donation-causes dc-single">
            <div class="col-md-7 col-lg-8 col-sm-7 col-xs-5 group">
              <div>
                <div class="progressBarRow col-lg-8 col-md-8 col-sm-8 col-xs-7">
                  <div class="row m0">
                    <div class="progress_barBox row m0">
                      <div class="progress">
                        <div
                          class="progress-bar"
                          role="progressbar"
                          aria-valuenow=""
                          aria-valuemin="0"
                          aria-valuemax="100"
                        >
                          <div class="percentage">
                            <span class="counter"></span>%
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="fund_raises style2 row m0">
                      <div class="col-xs-6 amount_box_raised">
                        <h6>recaudado</h6>
                        <h3>0</h3>
                      </div>
                      <div class="col-xs-6 amount_box_goal">
                        <h6>objetivo</h6>
                        <h3>{{ proyecto.objetivo }}</h3>
                      </div>
                    </div>
                  </div>
                </div>

                <div
                  class="
                    col-lg-3 col-md-3 col-sm-3 col-xs-5
                    sidebar
                    cause-sidebar
                  "
                >
                  <div class="row m0 widget widget-category">
                    <a href="#donate_box" class="btn-primary_cause"
                      >DONE AHORA</a
                    >
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-12 col-xs-12">
              <div class="embed-responsive embed-responsive-16by9">
                <iframe
                  style="border-radius: 9px"
                  :src="proyecto.video"
                  frameborder="0"
                  allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                  allowfullscreen
                ></iframe>
              </div>
            </div>
            <div class="gap-40"></div>

            <p v-html="proyecto.descripcion"></p>
          </div>
        </div>
      </div>
    </div>

    <div class="container">
      <div class="row footer_sidebar">
        <div class="widget widget-about col-sm-6 col-md-4">
          <div class="item">
            <img
              :src="'https://wipem.sfo3.digitaloceanspaces.com/' + ong.logo"
              alt=""
            />
          </div>
        </div>

        <div class="widget widget-contact col-sm-6 col-md-4">
          <h6 class="label label-default widget-title">MISIÓN</h6>
          <address>
            {{ ong.vision }}
          </address>
        </div>
        <div class="widget widget-contact col-sm-6 col-md-4">
          <h6 class="label label-default widget-title">VISIÓN</h6>
          <address>
            {{ ong.mision }}
          </address>
        </div>
      </div>
    </div>

    <div class="container galeria_container">
      <div class="heading-3 gap-50">
        <h5 class="text-center">GALERÍA</h5>
      </div>
      <div class="influencer-slider">
        <div class="home-slider" v-if="proyecto !== null">
          <Slick ref="slick" :options="slickOptions">
            <div v-for="(imagen, index) in proyecto.fotos" :key="index">
              <div
                class="hs-inner-galeria embed-responsive embed-responsive-4by3"
                v-bind:style="{
                  backgroundImage:
                    'url(https://wipem.sfo3.digitaloceanspaces.com/' +
                    imagen +
                    ')',
                }"
              ></div>
            </div>
          </Slick>
        </div>
      </div>
    </div>

    <!-- Buttons, Copy this to your Page Article -->
    <div class="container compartir heading-3 gap-30">
      <div class="text-center share-buttons-row">
        <h5 class="text-uppercase">Compartir:</h5>
        <!--Facebook's Button -->
        <ShareNetwork
          network="facebook"
          v-bind:title="this.proyecto.nombre"
          v-bind:description="this.proyecto.resumen_principal"
          v-bind:quote="
            this.proyecto.nombre + '\n' + this.proyecto.resumen_principal
          "
          v-bind:url="'https://wipem.com.bo/proyecto/' + this.proyecto.slug"
          v-bind:image="'https://wipem.com.bo/proyecto/' + proyecto.foto"
          v-bind:hashtags="'wipem, hola'"
        >
          <div class="share-fb"></div>
        </ShareNetwork>
        <ShareNetwork
          network="twitter"
          v-bind:title="
            this.proyecto.nombre + '\n' + this.proyecto.resumen_principal
          "
          v-bind:description="this.proyecto.resumen_principal"
          v-bind:quote="
            this.proyecto.nombre + '\n' + this.proyecto.resumen_principal
          "
          v-bind:url="'https://wipem.com.bo/proyecto/' + this.proyecto.slug"
          v-bind:image="'https://wipem.com.bo/proyecto/' + proyecto.foto"
          v-bind:hashtags="
            'wipem,' +
            this.proyecto.slug +
            ',' +
            this.proyecto.subcategoria.slug
          "
        >
          <div class="share-twitter"></div>
        </ShareNetwork>

        <!-- <div @click="compartirFacebook()" class="share-fb"></div> -->
        <!--Twitter's Button -->
        <!-- <div @click="compartirTwitter()" class="share-twitter"></div> -->
        <!--Facebook's Button -->
        <ShareNetwork
          network="whatsapp"
          v-bind:title="this.proyecto.nombre"
          v-bind:description="this.proyecto.resumen_principal"
          v-bind:quote="
            this.proyecto.nombre + '\n' + this.proyecto.resumen_principal
          "
          v-bind:url="'https://wipem.com.bo/proyecto/' + this.proyecto.slug"
          v-bind:image="'https://wipem.com.bo/proyecto/' + proyecto.foto"
          v-bind:hashtags="'wipem,' + this.proyecto.slug"
        >
          <div class="share-whatsapp"><img src="/images/whatsapp.png" /></div>
        </ShareNetwork>
        <!-- <div @click="compartirWhatsapp()" class="share-whatsapp">
          <img src="/images/whatsapp.png" />
        </div> -->
        <ShareNetwork
          network="linkedin"
          v-bind:title="this.proyecto.nombre"
          v-bind:description="this.proyecto.resumen_principal"
          v-bind:quote="
            this.proyecto.nombre + '\n' + this.proyecto.resumen_principal
          "
          v-bind:url="'https://wipem.com.bo/proyecto/' + this.proyecto.slug"
          v-bind:image="'https://wipem.com.bo/proyecto/' + proyecto.foto"
          v-bind:hashtags="'wipem,' + this.proyecto.slug"
        >
          <div class="share-linkedin"></div>
        </ShareNetwork>
        <!--Linkedin's Button -->
        <!-- <div @click="compartirLinkedin()" class="share-linkedin"></div> -->
        <!--Tumblr's Button -->
        <!-- <div @click="compartirTumblr()" class="share-tumblr"></div> -->
        <ShareNetwork
          network="tumblr"
          v-bind:title="this.proyecto.nombre"
          v-bind:description="
            this.proyecto.nombre + '\n' + this.proyecto.resumen_principal
          "
          v-bind:quote="
            this.proyecto.nombre + '\n' + this.proyecto.resumen_principal
          "
          v-bind:url="'https://wipem.com.bo/proyecto/' + this.proyecto.slug"
          v-bind:image="'https://wipem.com.bo/proyecto/' + proyecto.foto"
          v-bind:hashtags="'wipem,' + this.proyecto.slug"
        >
          <div class="share-tumblr"></div>
        </ShareNetwork>
      </div>
    </div>
  </div>
</template>

<script>
import $ from "jquery";
import Slick from "vue-slick";
import "slick-carousel/slick/slick.css";
export default {
  metaInfo() {
    return {
      title: "Proyecto " + this.proyecto.nombre + " | Wipem",
      meta: [
        { name: "description", content: this.proyecto.resumen_principal },
        { name: "author", content: this.ong.nombre },
        { property: "og:local", content: "es_ES" },
        { property: "og:type", content: "website" },
        { property: "og:title", content: this.proyecto.nombre },
        {
          property: "og:description",
          content: this.proyecto.resumen_principal,
        },
        {
          property: "og:url",
          content: "https://wipem.com.bo/proyecto/" + this.proyecto.slug,
        },
        { property: "og:site_name", content: "wipem.com.bo" },
        {
          property: "article:publisher",
          content: "[https://www.facebook.com/USERNAME]",
        },
        {
          property: "og:image",
          content:
            "https://wipem.sfo3.digitaloceanspaces.com/" +
            this.proyecto.foto_principal,
        },

        { name: "twitter:title", content: this.proyecto.nombre },
        {
          name: "twitter:description",
          content: this.proyecto.resumen_principal,
        },
        {
          name: "twitter:image",
          content:
            "https://wipem.sfo3.digitaloceanspaces.com/" +
            this.proyecto.foto_principal,
        },
        { name: "twitter:site", content: "@[TWITTER_USERNAME]" },
        { name: "twitter:creator", content: "@[TWITTER_USERNAME]" },
        { name: "twitter:via", content: "@[TWITTER_USERNAME]" },
        { name: "twitter:card", content: "photo" },
        {
          name: "twitter:url",
          content: "https://wipem.com.bo/proyecto/" + this.proyecto.slug,
        },
      ],
    };
  },
  components: { Slick },
  props: ["proyecto"],

  data() {
    return {
      overriddenNetworks: {
        custom: {
          sharer: "https://mycustomdomain.com",
          type: "popup",
        },
      },
      empresas: [],
      ong: {},
      imagenes: [],
      article: encodeURIComponent(window.location.href),
      slickOptions: {
        arrows: false,
        infinite: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        dots: true,
        autoplay: true,
        autoplaySpeed: 4000,
      },
    };
  },
  methods: {
    getEmpresas: function () {
      var url = "ongs/" + this.proyecto.ong_id;
      axios.get(url).then((res) => {
        this.ong = res.data;
      });
    },
    compartirFacebook: function () {
      this.open_window(
        "http://www.facebook.com/sharer/sharer.php?u=" + this.article,
        "facebook_share"
      );
    },
    compartirTwitter: function () {
      window.open(
        "http://twitter.com/share?url=" + this.article,
        "twitter_share"
      );
    },
    compartirLinkedin: function () {
      this.open_window(
        "https://www.linkedin.com/shareArticle?mini=true&url=" +
          this.article +
          "&title=" +
          this.proyecto.nombre +
          "&summary=&source=",
        "linkedin_share"
      );
    },
    compartirTumblr: function () {
      this.open_window(
        "http://www.tumblr.com/share/link?url=" +
          this.article +
          "&name=" +
          this.proyecto.nombre +
          "&description=" +
          this.proyecto.resumen_principal,
        "tumblr_share"
      );
    },
    compartirWhatsapp: function () {
      this.open_window("https://api.whatsapp.com/send?text=" + this.article);
    },
    open_window: function (url, name) {
      window.open(
        url,
        name,
        "height=320, width=640, toolbar=no, menubar=no, scrollbars=yes, resizable=yes, location=no, directories=no, status=no"
      );
    },
  },
  mounted() {
    this.getEmpresas();
  },
};
</script>
