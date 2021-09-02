<template>
  <div class="container influencer_container">
    <div class="heading-3 gap-50">
      <h5 class="text-center">Influencers</h5>
    </div>
    <div class="influencer-slider">
      <div
        class="imagen-influencer"
        v-bind:style="{
          backgroundImage: 'url(http://localhost:8000/storage/' + imagen + ')',
        }"
        style="no-repeat center 0"
      ></div>
    </div>
  </div>
</template>

<script>
import $ from "jquery";
export default {
  data() {
    return {
      imagen: "",
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
        this.imagen = res.data.images[0].imagen;
        console.log(res.data.images[0].imagen);
      });
    },
  },
  created() {
    this.getImagenes();
  },
};
</script>