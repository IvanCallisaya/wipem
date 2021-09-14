<template>
  <div>
    <Slick ref="slick" :options="slickOptions" v-if="imagenes.length > 0">
      <div v-for="(url, index) in imagenes" :key="index">
        <img
          class="imagen-index"
          :src="'https://wipem.sfo3.digitaloceanspaces.com/' + url"
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
      },
    };
  },
  methods: {
    getImagenes: function () {
      var url = "/imagenesProyecto";
      axios.get(url).then((res) => {
        this.imagenes = res.data.images[0].images;
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
