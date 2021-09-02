<template>
  <div>
    <!-- <div v-for="(imagen, index) in imagenes" :key="index">
      <Slick
        v-for="(url, index) in imagen.images"
        :key="index"
        v-bind:style="{
          backgroundImage: 'url(http://localhost:8000/storage/' + url + ')',
        }"
        style="no-repeat center 0"
      >
      </Slick>
    </div> -->
    <!-- <table class="table-auto">
      <thead>
        <tr>
          Imagenes
        </tr>
      </thead>
      <tbody>
        <tr v-for="(imagen, index) in imagenes" :key="index">
          <td v-for="(url, index) in imagen.images" :key="index">
            <img :src="'http://localhost:8000/storage/' + url" />
          </td>
        </tr>
      </tbody>
    </table> -->

    <Slick ref="slick" :options="slickOptions" v-if="imagenes.length > 0">
      <div v-for="(url, index) in imagenes" :key="index">
        <img
          class="imagen-index"
          :src="'http://localhost:8000/storage/' + url"
        />
      </div>
    </Slick>
  </div>
</template>
<script>
import Slick from "vue-slick";
import "slick-carousel/slick/slick.css";
import $ from "jquery";
export default {
  components: { Slick },
  data() {
    return {
      imagenes: "",
      errores: {},
      slickOptions: {
        arrows: false,
        infinite: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        dots: true,
        autoplay: true,
        autoplaySpeed: 4000,
        // Any other options that can be got from plugin documentation
      },
    };
  },
  methods: {
    getImagenes: function () {
      var url = "/imagenes";
      axios.get(url).then((res) => {
        this.imagenes = res.data.images[0].images;
        console.log(res.data.images[0]);
      });
    },
  },
  created() {
    this.getImagenes();
  },
};
</script>
<style>
.imagen-index {
  width: 100%;
  max-height: 410px;
  position: relative;
  background: rgba(0, 0, 0, 0.2);
  background-size: cover !important;
}
</style>
