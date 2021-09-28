<template>
  <div>
    <div v-if="categorias.length > 0">
      <div :key="componentKey">
        <div class="col-md-2 col-lg-2 sidebar cause-sidebar">
          <div class="row m0 sideNav widget-category">
            <h4 @click="getProyectos(0)" class="widget-title text-center">categorias</h4>
            <ul class="nav">
              <li
                v-for="(subcategoria, index) in subcategorias"
                :key="index"
                :class="{ active: actual == subcategoria.id }"
                                  @click="
                    getProyectos(
                      subcategoria.id,
                      0,
                      subcategoria.slug,
                      subcategoria.nombre
                    )
                  "
              >
                <img
                :src="
                  'https://wipem.sfo3.digitaloceanspaces.com/' +
                  subcategoria.logo
                "
              />
                <a

                >
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
          <div class="row item-pie">
            <ul class="gallery-pagination list-unstyled">
              <div>
                Pagina: {{ pagination.current_page }} -
                {{ pagination.last_page }} Total:
                {{ pagination.total_page }}
              </div>
              <li :class="{ disabled: !pagination.first_link }" class="prev">
                <a @click="getProyectos(id, pagination.first_link)" href="#"
                  >&laquo;</a
                >
              </li>
              <li
                :class="{ disabled: !pagination.prev_link }"
                class="page-no last-no"
              >
                <a @click="getProyectos(id, pagination.prev_link)" href="#"
                  >&lt;</a
                >
              </li>
              <li
                v-for="n in pagination.last_page"
                :key="n"
                :class="{ active: pagination.current_page == n }"
                class="page-no first-no"
              >
                <a @click="getProyectos(id, pagination.path_page + n)" href="#">
                  {{ n }}
                </a>
              </li>
              <li
                :class="{ disabled: !pagination.next_link }"
                class="page-no last-no"
              >
                <a @click="getProyectos(id, pagination.next_link)" href="#"
                  >&gt;</a
                >
              </li>
              <li :class="{ disabled: !pagination.last_link }" class="prev">
                <a @click="getProyectos(id, pagination.last_link)" href="#"
                  >&raquo;</a
                >
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>


<script>
import $ from "jquery";
export default {
  metaInfo() {
    return {
      title: "Proyectos " + this.nombreAct + " | Wipem",
      meta: [],
    };
  },
  data() {
    return {
      cargado: [],
      slugAnt: "",
      nombreAct: "",
      actual: 0,
      componentKey: 0,
      proyectos: [],
      porcentaje: 0,
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
    getProyectos(id = 0, pagi, slug = "", nombre = "") {
      console.log(this.slugAnt);
      if (id != 0) {
        this.actual = id;
      } else {
        this.actual = 0;
      }
      console.log(this.slugAnt + " " + slug);
      if (this.slugAnt !== "" && this.slugAnt !== slug) {
        history.pushState({}, null, "/causas/" + this.slugAnt);
        this.nombreAct = "de "+ nombre;
      } else if (slug == "") {
        history.pushState({}, null, "/causas/" + "todas");
        this.nombreAct = "Sociales en Bolivia";
      } else {
        history.pushState({}, null, "/causas/" + slug);
        this.nombreAct = "de " + nombre;
      }
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
    async getCategorias() {
      var url = "/categorias";
      await axios.get(url).then((res) => {
        this.categorias = res.data;
        console.log(this.categorias);
        this.getSubcategorias(res.data);
        this.getProyectos(this.id);
        this.componentKey += 1;
      });
    },
    getSubcategorias(categorias) {
      for (let i = 0; i < categorias.length; i++) {
        for (let j = 0; j < categorias[i].subcategorias.length; j++) {
          this.subcategorias.push(categorias[i].subcategorias[j]);
        }
      }
      const newObject = { ...this.subcategorias };
      for (let i = 0; i < newObject.length; i++) {
        // if(newObject[i].id == this.id)
        // this.slugAnt = newObject[i].slug;
        console.log(newObject.size);
      }
      for (let prop in newObject) {
        if (newObject[prop].id == this.id) {
          this.slugAnt = newObject[prop].slug;
          this.nombreAct = newObject[prop].nombre;
        }
      }

      console.log(this.slugAnt);
    },
    ir(slug) {
      window.open("/proyecto/" + slug, "_self");
    },
  },
  created() {
    this.id = window.location.pathname.slice(
      8,
      window.location.pathname.length
    );
    console.log(this.id);

    var intval = setInterval(() => {
      if (this.percentage < this.porcentaje) this.percentage += 1;
      else clearInterval(intval);
    }, 40);
  },
  mounted() {
    this.getCategorias();
  },
};
</script>