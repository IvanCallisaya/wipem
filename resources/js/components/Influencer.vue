<template>
  <div>
    <!-- <div class="row" >
      <div v-for="(empresa, index) in empresas" :key="index" class="col-sm-3">
        <div class="empresas">
          <img :src="empresa.logo" alt="" />
        </div>
      </div>
    </div> -->

    <Slick ref="slick" :options="slickOptions" v-if="empresas.length > 0">
      <div class="empresas" v-for="(empresa, index) in empresas" :key="index">
        <img
          :src="'https://wipem.sfo3.digitaloceanspaces.com/' + empresa.logo"
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
      empresas: [],
      slickOptions: {
        prevArrow:
          "<button type='button' class='slick-prev pull-left'><i class='fa fa-angle-left' aria-hidden='true'></i></button>",
        nextArrow:
          "<button type='button' class='slick-next pull-left'><i class='fa fa-angle-right' aria-hidden='true'></i></button>",
        infinite: true,
        slidesToShow: 5,
        slidesToScroll: 1,
        responsive: [
          {
            breakpoint: 1100,
            settings: {
              slidesToShow: 4,
              slidesToScroll: 1,
              infinite: true,
            },
          },
          {
            breakpoint: 900,
            settings: {
              slidesToShow: 3,
              slidesToScroll: 1,
            },
          },
          {
            breakpoint: 670,
            settings: {
              slidesToShow: 2,
              slidesToScroll: 2,
            },
          },
          {
            breakpoint: 490,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1,
            },
          },
          // You can unslick at a given breakpoint now by adding:
          // settings: "unslick"
          // instead of a settings object
        ],
      },
    };
  },
  methods: {
    getEmpresas: function () {
      var url = "/sponsor/influencer";
      axios.get(url).then((res) => {
        this.empresas = res.data;
      });
    },
  },
  mounted() {
    this.getEmpresas();
  },
};
</script>

<style>
.features .empresas {
  margin: 10px 0px 10px;
  position: relative;
  display: table;
  background: #ffffff;
  border-radius: 20px;
  box-shadow: 2px 2px 2px 2px #ccc;
  height: 150px;
  max-width: 200px;
}

.empresas img {
  display: block;
  margin: 0 auto;
  position: relative;
  width: 100%;
  height: 100%;
  border-radius: 20px;
  top: 50%;
  transform: translateY(-50%);
}

.slick-slide {
  width: 270px;
}
</style>
