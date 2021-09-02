<template>
  <div :key="componentKey">
    <div class="col-md-2 col-lg-2 sidebar cause-sidebar">
      <div class="row m0 sideNav widget-category">
        <h4 class="widget-title">categorias</h4>
        <ul class="nav">
          <li v-for="(subcategoria, index) in subcategorias" :key="index">
            <a @click="getProyectos(subcategoria.id)">
              {{ subcategoria.nombre }}
            </a>
          </li>
        </ul>
      </div>
    </div>

    <div
      class="col-md-10 col-lg-10 single-project single-cause m-0"
      :key="componentKey"
    >
      <div v-for="(proyecto, index) in proyectos.data" :key="index">
        <div class="card">
          <img
            :src="'http://localhost:8000/storage/' + proyecto.foto_principal"
            class="card-img-top"
            alt="..."
          />
          <div class="card-body">
            <h2 @click="myBook(proyecto.id)" class="card-title text-uppercase">
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
                <h4>20</h4>
              </div>
              <div class="objetivo col-md-6 col-xs-6 p-0">
                <h6>objetivo</h6>
                <h4>{{ proyecto.objetivo }}</h4>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row item-pie">

        
          <ul class="gallery-pagination list-unstyled">
                <div>
          Pagina: {{ pagination.current_page }} - {{ pagination.last_page }} Total:
          {{ pagination.total_page }}
        </div>
            <li :class="{ disabled: !pagination.first_link }" class="prev">
              <a @click="getProyectos(id, pagination.first_link)" href="#"
                >&laquo;</a
              >
            </li>
            <li :class="{ disabled: !pagination.prev_link }" class="page-no last-no">
              <a @click="getProyectos(id, pagination.prev_link)" href="#"
                >&lt;</a
              >
            </li>
            <li
              v-for="n in pagination.last_page"
              :key="n"
              :class="{ active: pagination.current_page == n }"
              class="page-no first-no "
            >
              <a @click="getProyectos(id, pagination.path_page + n)" href="#" >
                {{ n }}
              </a>
            </li>
            <li :class="{ disabled: !pagination.next_link }" class="page-no last-no">
              <a @click="getProyectos(id, pagination.next_link)" href="#"
                >&gt;</a
              >
            </li>
            <li :class="{ disabled: !pagination.last_link }" class="prev" > 
              <a @click="getProyectos(id, pagination.last_link)" href="#"
                >&raquo;</a
              >
            </li>
          </ul>
        
          
      </div>
    </div>
  </div>
</template>


<script>
import $ from "jquery";
export default {
  components: {},
  data() {
    return {
      active_el:0,
      componentKey: 0,
      proyectos: [],
      porcentaje: 50,
      percentage: 0,
      categorias: [],
      subcategorias: [],
      slickOptions: {
        dots: true,
        arrows: false,
        slidesToShow: 3,
        rows: 0,
        infinite: false,
      },
      id: 0,
      pagination: {},
    };
  },
  methods: {
    getProyectos: function (id = 0, pagi, n) {
      this.id = id;
      pagi = pagi || "/causa/" + id;

      axios.get(pagi).then((res) => {
        this.proyectos = res.data;
        console.log(res.data);
        this.pagination = {
          current_page: res.data.current_page,
          last_page: res.data.last_page,
          from_page: res.data.from,
          to_page: res.data.to,
          total_page: res.data.total,
          path_page: res.data.path + "?page=",
          first_link: res.data.first_page_url,
          prev_link: res.data.prev_page_url,
          next_link: res.data.next_page_url,
          last_link: res.data.last_page_url,
        };
        
      });
    },
    getCategorias: function () {
      var url = "/categorias";
      axios.get(url).then((res) => {
        this.categorias = res.data;
        console.log(res.data);
        this.getSubcategorias(res.data);
        this.componentKey += 1;
      });
    },
    getSubcategorias: function (categorias) {
      for (let i = 0; i < categorias.length; i++) {
        for (let j = 0; j < categorias[i].subcategorias.length; j++) {
          this.subcategorias.push(categorias[i].subcategorias[j]);
        }
      }
    },
    myBook(id) {
      window.open("/proyecto/" + id, "_blank");
    },
  },
  created() {
    this.id = window.location.pathname.slice(
      8,
      window.location.pathname.length
    );
    var intval = setInterval(() => {
      if (this.percentage < this.porcentaje) this.percentage += 1;
      else clearInterval(intval);
    }, 40);
  },
  mounted() {
    this.getProyectos(this.id);
    this.getCategorias();

    
  },
};
</script>