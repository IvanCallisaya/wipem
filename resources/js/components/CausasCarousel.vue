<template>
  <div>
    <Slick :options="slickOptions" v-if="proyectos.length > 0">
      <div v-for="(proyecto, index) in proyectos" :key="index">
        <div @click="ir(proyecto.slug)" class="card">
          <img
            :src="
              'https://wipem.sfo3.digitaloceanspaces.com/' +
              proyecto.foto_principal
            "
            class="card-img-top"
            alt="..."
          />
          <div class="card-body">
            <h2 class="card-title text-uppercase">
              {{ proyecto.nombre }}
            </h2>
            <p class="card-text">{{ proyecto.resumen_principal }}</p>
          </div>
          <div class="card-footer">
            <div class="loading-bar">
              <div class="percentage" :style="{ width: percentage + '%' }">
                <div class="porcentaje">
                  <span>{{ percentage }}%</span>
                </div>
              </div>
            </div>
            <div class="">
              <div class="recaudado col-md-6 col-xs-6 p-0">
                <h6>recaudado</h6>
                <h4>0</h4>
              </div>
              <div class="objetivo col-md-6 col-xs-6 p-0">
                <h6>objetivo</h6>
                <h4>{{ proyecto.objetivo }}</h4>
              </div>
            </div>
          </div>
        </div>
      </div>
    </Slick>
  </div>
</template>
<script>
import Slick from "vue-slick";
import "slick-carousel/slick/slick.css";
export default {
  metaInfo() {
    return {
      title: "Wipem | Crowdfunding y Fundraising en Bolivia",
      meta: [],
    };
  },
  components: { Slick },
  data() {
    return {
      percentage: 0,
      porcentaje: 0,
      proyectos: [],
      slickOptions: {
        dots: true,
        arrows: false,
        slidesToShow: 3,
        rows: 0,
        infinite: true,
        responsive: [
          {
            breakpoint: 780,
            settings: {
              slidesToShow: 2,
              slidesToScroll: 2,
              infinite: true,
            },
          },
          {
            breakpoint: 500,
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
    getProyectos: function () {
      var url = "/destacados";
      axios.get(url).then((res) => {
        this.proyectos = res.data;
      });
    },
    ir: function (slug) {
      window.open("/proyecto/" + slug, "_self");
    },
  },

  mounted() {
    this.getProyectos();
  },
  created() {
    var intval = setInterval(() => {
      if (this.percentage < this.porcentaje) this.percentage += 1;
      else clearInterval(intval);
    }, 10);
  },
};
</script>
