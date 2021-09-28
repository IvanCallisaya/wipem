<template>
  <div>
    <div class="row f-inner">
      <h5 class="text-center">CROWDFUNDING Y FUNDRAISING EN BOLIVIA</h5>

      <div class="col-md-12 text-center">
        <ul>
          <li v-for="(categoria, index) in categorias" :key="index">
            <img
              class="image_headers"
              :src="
                'https://wipem.sfo3.digitaloceanspaces.com/' + categoria.logo
              "
              alt=""
            />
            <a class="categoria"> {{ categoria.nombre }} </a>
          </li>
        </ul>
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
            <img
              :src="
                'https://wipem.sfo3.digitaloceanspaces.com/' + subcategoria.logo
              "
              alt=""
            />
          </div>
          <div class="f-inner">
            <a class="subcategoria" @click="causas(subcategoria.id)">
              {{ subcategoria.nombre }}
            </a>
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
      window.open("/causas/" + id, "_self");
    },
  },
  mounted() {
    this.getCategorias();
  },
};
</script>
