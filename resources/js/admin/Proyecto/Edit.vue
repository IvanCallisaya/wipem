<template>
  <div class="container">
    <h5>Editar Proyecto</h5>

    <form id="formId" @submit.prevent="guardar">
      <div class="my-2">
        <label for="nombre">Nombre</label>
        <input
          v-model="proyecto.nombre"
          type="text"
          class="form-control"
          id="nombre"
          placeholder="Nombre de la proyecto"
        />
        <span class="text-danger" v-if="errores.nombre">
          {{ errores.nombre[0] }}
        </span>
      </div>
      <div class="my-2">
        <label for="plan_id">Plan</label>
        <select
          v-model="proyecto.plan_id"
          class="form-control form-control-lg form-control-solid"
        >
          <option v-for="plan in this.planes" :value="plan.id" :key="plan.id">
            {{ plan.nombre }}
          </option>
        </select>

        <span class="text-danger" v-if="errores.video">
          {{ errores.video[0] }}
        </span>
      </div>
      <div class="my-2">
        <label> Seleccione uno o más sponsors </label>
        <select
          class="select2-blue"
          id="js-multiple"
          name="sponsor_ids[]"
          multiple="multiple"
        >
          <option
            v-for="sponsor in this.sponsors"
            :value="sponsor.id"
            :key="sponsor.id"
          >
            {{ sponsor.nombre }}
          </option>
        </select>
      </div>
      <div class="my-2">
        <label for="subcategoria_id">Subcategoria</label>
        <select
          id="categoria-select"
          class="select2-blue"
          v-model="proyecto.subcategoria_id"
        >
          <option
            v-for="subcategoria in this.subcategorias"
            :value="subcategoria.id"
            :key="subcategoria.id"
          >
            {{ subcategoria.nombre }}
          </option>
        </select>
        <span class="text-danger" v-if="errores.video">
          {{ errores.video[0] }}
        </span>
      </div>
      <div class="my-2">
        <label for="objetivo">objetivo</label>
        <input
          v-model="proyecto.objetivo"
          type="number"
          step="any"
          class="form-control"
          id="objetivo"
          placeholder="objetivo de la proyecto"
        />
        <span class="text-danger" v-if="errores.nombre">
          {{ errores.nombre[0] }}
        </span>
      </div>
      <div class="my-2">
        <label for="video">Video</label>
        <input
          v-model="proyecto.video"
          type="text"
          class="form-control"
          id="video"
          placeholder="Video del proyecto"
        />
        <span class="text-danger" v-if="errores.nombre">
          {{ errores.nombre[0] }}
        </span>
      </div>
      <div class="my-2">
        <label for="fecha_final">fecha_final</label>
        <input
          v-model="proyecto.fecha_final"
          type="date"
          class="form-control"
          id="fecha_final"
          placeholder="fecha_final de la proyecto"
        />
        <span class="text-danger" v-if="errores.nombre">
          {{ errores.nombre[0] }}
        </span>
      </div>
      <div class="my-2">
        <label class="mr-4" for="imagenes">Imagen principal del proyecto</label>
        <input @change="handleOnChange" type="file" id="imagenes" />
        <span class="text-danger" v-if="errores.nombre">
          {{ errores.nombre[0] }}
        </span>
      </div>
      <div class="my-2">
        <input
          class="form-check-input ml-0 mr-4"
          type="checkbox"
          id="gridCheck"
          v-model="proyecto.destacado"
        />
        <label class="form-check-label ml-4" for="gridCheck">
          Destacado {{ proyecto.destacado }}
        </label>
      </div>
      <div class="my-2">
        <label for="resumen_principal">resumen_principal</label>
        <input
          v-model="proyecto.resumen_principal"
          type="text"
          class="form-control"
          id="resumen_principal"
          placeholder="resumen_principal de la proyecto"
        />
        <span class="text-danger" v-if="errores.nombre">
          {{ errores.nombre[0] }}
        </span>
      </div>
      <div class="my-2">
        <label for="resumen_principal">Estado</label>
        <select
          v-model="proyecto.plan_id"
          class="form-control form-control-lg form-control-solid"
        >
          <option value="Santa Cruz">activo</option>
          <option value="La Paz">inactivo</option>
          <option value="Cochabamba">completado</option>
        </select>
      </div>
      <div class="my-2">
        <label for="descripcion">Descripcion</label>
        <froala
          id="edit"
          :tag="'textarea'"
          :config="config"
          v-model="proyecto.descripcion"
        ></froala>

        <div>
          <label class="mr-4" for="imagenes">Imagenes</label>
          <input
            @change="imageChange"
            class="hidden my-4"
            type="file"
            name="image"
            ref="files"
            multiple
          />
        </div>
        <div>
          <p class="my-0" v-for="(image, index) in imagenes" :key="index">
            {{ image.name }}
          </p>
        </div>
      </div>
      <button class="btn btn-success">Guardar</button>
      <router-link to="/proyectos" class="btn btn-secondary"
        >Cancelar</router-link
      >
    </form>
    <pre> {{ proyecto }} </pre>
  </div>
</template>

<script>
import $ from "jquery";
import "select2";
import "select2/dist/css/select2.css";

export default {
  data() {
    return {
      proyecto: {
        id: 0,
        nombre: "",
        video: "",
        objetivo: 0,
        descripcion: "",
        fecha_final: "",
        foto_principal: "",
        resumen_principal: "",
        fotos: "",
        foto_principal: "",
        imagenes: [],
        sponsor_ids: [],
        subcategoria_id: 0,
        plan_id: 0,
        destacado: false,
        slug: "",
        estado: "",
      },
      imagenes: [],
      sponsors: [],
      planes: [],
      categorias: [],
      subcategorias: [],
      errores: {},
      config: {
        events: {},

        toolbarButtons: [
          [
            "bold",
            "italic",
            "underline",
            "strikeThrough",
            "subscript",
            "superscript",
          ],
          ["fontFamily", "fontSize", "textColor", "backgroundColor"],
          ["inlineClass", "inlineStyle", "clearFormatting"],
        ],
      },
    };
  },
  methods: {
    handleOnChange(e) {
      this.image = e.target.files[0];
      console.log(this.image);
    },
    upload(e) {
      const formData = new FormData();
      console.log(formData);
    },
    getProyecto() {
      var url = "/admin/proyectos/" + this.$route.params.id;
      axios.get(url).then((res) => {
        this.proyecto = res.data;
      });
    },
    guardar() {
      this.proyecto.slug = this.convertToSlug(this.proyecto.nombre);
      this.proyecto.subcategoria_id = $("#categoria-select").val();
      var self = this;
      let formData = new FormData();
      this.proyecto.sponsor_ids = Array.from(
        $("#js-multiple").select2("data")
      ).map((option) => option.id);
      if (this.imagenes.length == 0) {
        formData.append("files", 0);
      } else {
        for (let i = 0; i < this.imagenes.length; i++) {
          let file = self.imagenes[i];
          formData.append("files[" + i + "]", file);
        }
      }
      console.log(this.proyecto.sponsor_ids.length);
      if (this.proyecto.sponsor_ids.length == 0) {
        formData.append("sponsor_ids", 0);
      } else {
        for (let i = 0; i < this.proyecto.sponsor_ids.length; i++) {
          formData.append(
            "sponsor_ids[" + i + "]",
            this.proyecto.sponsor_ids[i]
          );
        }
      }
      if (this.image == null) {
        formData.set("foto_principal", "");
      } else {
        formData.set("foto_principal", this.image);
      }
      formData.set("nombre", this.proyecto.nombre);
      formData.set("id", this.proyecto.id);
      formData.set("video", this.proyecto.video);
      formData.set("objetivo", this.proyecto.objetivo);
      formData.set("descripcion", this.proyecto.descripcion);
      formData.set("fecha_final", this.proyecto.fecha_final);
      formData.set("resumen_principal", this.proyecto.resumen_principal);
      formData.set("subcategoria_id", this.proyecto.subcategoria_id);
      formData.set("plan_id", this.proyecto.plan_id);
      formData.set("destacado", Number(this.proyecto.destacado));
      formData.set("slug", this.proyecto.slug);
      formData.set("estado", this.proyecto.estado);
      for (var p of formData) {
        let name = p[0];
        let value = p[1];
        let type = typeof p[1];
        console.log(name, value, type);
      }

      const config = {
        header: { "content-type": "multipart/form-data" },
      };
      let url = "/admin/proyectoUpdate/" + this.proyecto.slug;
      axios
        .post(url, formData, config)
        .then((response) => {
          console.log(response);
          self.$refs.files.value = "";
          self.imagenes = [];
          swal("Exito!", "Proyecto editado correctamente", "success");
          window.open("/admin#/proyectos", "_self");
        })
        .catch((err) => {
          console.log(err);
        });
    },
    getParams() {
      console.log($("#js-multiple").select2("data"));
    },
    getPlanes: function () {
      $.noConflict();
      axios.get("/admin/planes").then((res) => {
        this.planes = res.data;
      });
      axios.get("/admin/categorias").then((res) => {
        this.getSubcategorias(res.data);
      });
      axios.get("/admin/sponsor/get").then((res) => {
        this.sponsors = res.data;
      });
    },

    getSubcategorias: function (categorias) {
      for (let i = 0; i < categorias.length; i++) {
        for (let j = 0; j < categorias[i].subcategorias.length; j++) {
          this.subcategorias.push(categorias[i].subcategorias[j]);
        }
      }
    },
    imageChange() {
      for (let i = 0; i < this.$refs.files.files.length; i++) {
        this.imagenes.push(this.$refs.files.files[i]);
        console.log(this.imagenes);
      }
    },
    uploadimagenes() {
      var self = this;
      let formData = new FormData();
      for (let i = 0; i < this.imagenes.length; i++) {
        let file = self.imagenes[i];
        formData.append("files[" + i + "]", file);
      }
    },
  },
  mounted() {
    const self = this;
    this.getProyecto();
    this.getPlanes();
    $(document).ready(function () {
      $("#js-multiple").select2({
        theme: "classic",
        width: "100%",
      });
    });
    $("#categoria-select").select2({
      theme: "classic",
      width: "100%",
    });
    $("#categoria-select").on("select2:select", (e) => {
      var data = e.params.data;
      self.proyecto.subcategoria_id = data.id;
      console.log(self.proyecto.subcategoria_id);
    });
  },
};
</script>

<style>
.mostrar {
  display: list-item;
  opacity: 1;
  background: rgba(75, 56, 143, 0.705);
}
</style>