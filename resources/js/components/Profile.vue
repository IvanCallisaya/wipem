<template>
  <div>
    <div class="d-flex flex-column-fluid">
      <div class="container">
        <div class="card card-custom">
          <div class="card-header flex-wrap border-0 pt-6 pb-0">
            <div class="card-title">
              <h3 class="card-label">Lista de articulos</h3>
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
                    <div class="my-4">
                      <label for="nombre">Nombre</label>
                      <input
                        v-model="plan.nombre"
                        type="text"
                        class="form-control"
                        id="nombre"
                        placeholder="Nombre del plan"
                      />
                      <span class="text-danger" v-if="errores.nombre">
                        {{ errores.nombre[0] }}
                      </span>
                    </div>

                    <div class="my-4">
                      <label for="description">description</label>
                      <input
                        v-model="plan.description"
                        type="text"
                        class="form-control"
                        id="description"
                        placeholder="description del plan"
                      />
                      <span class="text-danger" v-if="errores.description">
                        {{ errores.description[0] }}
                      </span>
                    </div>
                    <div class="my-4">
                      <label for="stock">stock</label>
                      <input
                        v-model="plan.stock"
                        type="number"
                        class="form-control"
                        id="stock"
                        placeholder="stock del plan"
                      />
                      <span class="text-danger" v-if="errores.stock">
                        {{ errores.stock[0] }}
                      </span>
                    </div>
                  </div>

                  <!-- Modal footer -->
                  <div class="modal-footer">
                    <button
                      @click="cerrarModal()"
                      type="button"
                      class="btn btn-secondary"
                      data-dismiss="modal"
                    >
                      Cancelar
                    </button>
                    <button
                      @click="guardar()"
                      type="button"
                      class="btn btn-success"
                      data-dismiss="modal"
                    >
                      Guardar
                    </button>
                  </div>
                </div>
              </div>
            </div>

            <table class="table table-hover table-bordered" id="sampleTable">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Título</th>
                  <th>stock</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="plan in articulos" :key="plan.id">
                  <td>{{ plan.nombre }}</td>
                  <td>{{ plan.description }}</td>
                  <td>{{ plan.stock }}</td>
                  <td>
                    <button
                      @click="
                        modificar = true;
                        abrirModal(plan);
                      "
                      class="btn btn-warning"
                    >
                      <i class="fas fa-edit"> </i>
                    </button>
                    <button @click="eliminar(plan)" class="btn btn-danger">
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
import datatable from "datatables.net-responsive-bs4";
import $ from "jquery";
import swal from "sweetalert";
require("bootstrap");

export default {
  data() {
    return {
      plan: {
        id: 0,
        nombre: "yy",
        description: "yuu",
        stock: 0,
      },
      id: 0,
      modificar: true,
      modal: 0,
      tituloModal: "",
      articulos: [],
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
    getarticulos: function () {
      $.noConflict();
      var url = "/admin/articulos";
      axios.get(url).then((res) => {
        this.articulos = res.data;
        $("#sampleTable").DataTable().destroy();
        this.table();
      });
    },
    async eliminar(plan) {
      swal({
        title: "Estas seguro de eliminar el idioma " + plan.nombre + "?",
        text: "Una vez eliminado no lo podras recuperar!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      }).then((willDelete) => {
        if (willDelete) {
          let url = "/admin/articulos/" + plan.id;
          axios
            .delete(url)
            .then((res) => {
              this.getarticulos();
              console.log(res.data);
              swal("Exito!", "Usuario eliminado correctamente", "success");
            })
            .catch((error) => {
              console.log(error);
              swal("Error!", "Intentelo de nuevo", "error");
            });
        }
      });
    },
    async guardar() {
      try {
        if (this.modificar) {
          let url = "/admin/articulos/" + this.id;
          axios.put(url, this.plan).then((res) => {
            console.log(res);
            this.getarticulos();
            swal("Exito!", "Usuario editado correctamente", "success");
          });
        } else {
          let url = "/admin/articulos/";
          axios.post(url, this.plan).then((res) => {
            this.id = "";
            this.getarticulos();
          });
        }
        // this.cerrarModal();
      } catch (error) {
        if (error) {
          this.errores = error;
          console.log('ERRRRR'+ error);
        }
      }
    },
    abrirModal(data = {}) {
      this.modal = 1;
      if (this.modificar) {
        this.id = data.id;
        this.tituloModal = "Modificar plan";
        this.plan.nombre = data.nombre;
        this.plan.description = data.description;
        this.plan.stock = data.stock;
      } else {
        this.id = 0;
        this.tituloModal = "Crear plan";
        this.plan.nombre = "";
        this.plan.description = "";
        this.plan.stock = 1;
      }
    },
    cerrarModal() {
      this.modal = 0;
      this.errores = {};
    },
  },
  created() {
    this.getarticulos();
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