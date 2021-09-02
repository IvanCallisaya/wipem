<template>
  <div>
    <div class="d-flex flex-column-fluid">
      <div class="container">
        <div class="card card-custom">
          <div class="card-header flex-wrap border-0 pt-6 pb-0">
            <div class="card-title">
              <h3 class="card-label">Lista de categorias</h3>
            </div>
            <button
              @click="
                modificar = false;
                abrirModal();
              "
              type="button"
              class="btn btn-primary my-4"
            >
              Nuevo
            </button>
          </div>
          <div class="container">
            <div class="modal" :class="{ mostrar: modal }">
              <div class="modal-dialog">
                <div class="modal-content">
                  <!-- Modal Header -->
                  <div class="modal-header">
                    <h4 class="modal-title">{{ tituloModal }}</h4>
                    <button
                      @click="cerrarModal()"
                      type="button"
                      class="close"
                      data-dismiss="modal"
                    >
                      &times;
                    </button>
                  </div>

                  <!-- Modal body -->
                  <div class="modal-body">
                    <form id="formId" @submit.prevent="upload">
                      <input @change="handleOnChange" type="file" />

                      <div class="my-4">
                        <label for="nombre">Nombre</label>
                        <input
                          v-model="categoria.nombre"
                          type="text"
                          class="form-control"
                          id="nombre"
                          placeholder="Nombre de la categoria"
                        />
                        <span class="text-danger" v-if="errores.nombre">
                          {{ errores.nombre[0] }}
                        </span>
                      </div>
                      <div class="my-4">
                        <label for="descripcion">Descripcion</label>
                        <input
                          v-model="categoria.descripcion"
                          type="text"
                          class="form-control"
                          id="descripcion"
                          placeholder="descripcion del categoria"
                        />
                        <span class="text-danger" v-if="errores.descripcion">
                          {{ errores.descripcion[0] }}
                        </span>
                      </div>
                      <button class="btn btn-success">Guardar</button>
                      <button @click="cerrarModal()" class="btn btn-secondary">
                        Cancelar
                      </button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
            <table class="table table-hover table-bordered" id="sampleTable">
              <thead>
                <tr>
                  <th>Logo</th>
                  <th>Nombre</th>
                  <th>Descripcion</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody>
                <tr
                  v-for="subcategoria in categorias.subcategorias"
                  :key="subcategoria.id"
                >
                  <td>
                    <img
                      v-bind:src="subcategoria.logo"
                      width="50"
                      height="50"
                    />
                  </td>
                  <td>{{ subcategoria.nombre }}</td>
                  <td>{{ subcategoria.descripcion }}</td>
                  <td>
                    <button
                      @click="
                        modificar = true;
                        abrirModal(subcategoria);
                      "
                      class="btn btn-warning"
                    >
                      <i class="fas fa-edit"> </i>
                    </button>

                    <button
                      @click="eliminar(subcategoria)"
                      class="btn btn-danger"
                    >
                      <i class="fas fa-trash"> </i>
                    </button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>



<script>
import $ from "jquery";

export default {
  data() {
    return {
      categoria: {
        id: 0,
        nombre: "",
        descripcion: "",
        logo: "",
        categoria_id: this.$route.params.id,
      },
      id: 0,
      modificar: true,
      modal: 0,
      tituloModal: "",
      categorias: [],
      errores: {},
    };
  },
  methods: {
    table: function () {
      this.$nextTick(() => {
        $("#sampleTable").DataTable({
          order: [[0, "desc"]],
        });
      });
    },
    handleOnChange(e) {
      this.image = e.target.files[0];
      console.log(this.image);
    },
    upload(e) {
      const formData = new FormData();
      formData.set("image", this.image);
      console.log(formData);
      axios.post("/uploadCategoria", formData).then((res) => {
        this.categoria.logo = "http://localhost:8000/storage/" + res.data;
        this.guardar();
        $("#formId")[0].reset();
      });
    },
    getCategorias: function () {
      $.noConflict();
      var url = "/admin/categorias/" + this.$route.params.id;
      console.log(this.$route);
      axios.get(url).then((res) => {
        this.categorias = res.data;
        $("#sampleTable").DataTable().destroy();
        this.table();
      });
    },
    async eliminar(categoria) {
      swal({
        title:
          "Estas seguro de eliminar la categoria " + categoria.nombre + "?",
        text: "Una vez eliminado no lo podras recuperar!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      }).then((willDelete) => {
        if (willDelete) {
          let url = "/admin/subcategorias/" + categoria.id;
          axios
            .delete(url)
            .then((res) => {
              this.getCategorias();
              swal("Exito!", "Subcategoria eliminada correctamente", "success");
            })
            .catch((error) => {
              console.log(error);
              swal("Error!", "Intentelo de nuevo", "error");
            });
        }
      });
    },
    guardar() {
      if (this.modificar) {
        let url = "/admin/subcategorias/" + this.id;
        axios
          .put(url, this.categoria)
          .then((res) => {
            console.log(res);
            this.getCategorias();
            this.cerrarModal();
            swal("Exito!", "Usuario editado correctamente", "success");
          })
          .catch((e) => {
            this.errores = e.response.data.errors;
          });
      } else {
        let url = "/admin/subcategorias/";
        axios
          .post(url, this.categoria)
          .then((res) => {
            this.id = "";
            this.getCategorias();
            this.cerrarModal();
          })
          .catch((e) => {
            this.errores = e.response.data.errors;
          });
      }
    },
    getErrores(errors) {
      this.errores = errors;
    },
    abrirModal(data = {}) {
      this.modal = 1;
      if (this.modificar) {
        this.id = data.id;
        this.tituloModal = "Modificar subcategorias";
        this.categoria.nombre = data.nombre;
        this.categoria.descripcion = data.descripcion;
      } else {
        this.id = 0;
        this.tituloModal = "Crear subcategorias";
        this.categoria.nombre = "";
        this.categoria.descripcion = "";
      }
    },
    cerrarModal() {
      this.modal = 0;
      this.errores = {};
    },
  },
  created() {
    this.getCategorias();
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