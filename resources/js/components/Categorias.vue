<template>
  <div>
    <div class="container">
      <h5 class="text-center">GATEGORÍAS</h5>
      <div class="row categorias_header">
        <div
          class="col-sm-12 col-md-6 col-lg-6"
          v-for="(categoria, index) in categorias"
          :key="index"
        >
          <div class="item_header">
            <div class="icon">
              <img class="image_headers" :src="categoria.logo" alt="" />
            </div>
            <div class="f-inner">
              <a> {{ categoria.nombre }} </a>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="container-fluid">
      <div
        class="col-xs-12 col-sm-6 col-md-4 col-lg-3"
        v-for="(subcategoria, index) in subcategorias"
        :key="index"
      >
        <div class="item">
          <div class="icon">
            <img :src="subcategoria.logo" alt="" />
          </div>
          <div class="f-inner">
            <a @click="causas(subcategoria.id)"> {{ subcategoria.nombre }} </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  components: {},
  data() {
    return {
      categorias: [],
      subcategorias: [],
      slickOptions: {
        slidesToShow: 4,
        arrows: true,
        dots: true,
      },
    };
  },
  methods: {
    getCategorias: function () {
      var url = "/categorias";
      axios.get(url).then((res) => {
        this.categorias = res.data;
        this.getSubcategorias(res.data);
      });
    },
    getSubcategorias: function (categorias) {
      for (let i = 0; i < categorias.length; i++) {
        for (let j = 0; j < categorias[i].subcategorias.length; j++) {
          this.subcategorias.push(categorias[i].subcategorias[j]);
        }
      }
    },
    causas(id) {
      window.open("/causas/" + id, "_blank");
    },
  },
  mounted() {
    this.getCategorias();
  },
};
</script>
