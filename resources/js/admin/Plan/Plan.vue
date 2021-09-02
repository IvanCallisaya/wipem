<template>
  <div>
    <div class="d-flex flex-column-fluid">
      <div class="container">
        <div class="card card-custom">
          <div class="card-header flex-wrap border-0 pt-6 pb-0">
            <div class="card-title">
              <h3 class="card-label">Lista de Planes</h3>
            </div>
            <button
              @click="
                modificar = false;
                abrirModal();
              "
              type="button"
              class="btn btn-primary my-4"
            >
              Nuevos
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
                      <label for="descripcion">Descripcion</label>
                      <input
                        v-model="plan.descripcion"
                        type="text"
                        class="form-control"
                        id="descripcion"
                        placeholder="descripcion del plan"
                      />
                      <span class="text-danger" v-if="errores.descripcion">
                        {{ errores.descripcion[0] }}
                      </span>
                    </div>
                    <div class="my-4">
                      <label for="valor">valor</label>
                      <input
                        v-model="plan.valor"
                        type="number"
                        class="form-control"
                        id="valor"
                        placeholder="valor del plan"
                      />
                      <span class="text-danger" v-if="errores.valor">
                        {{ errores.valor[0] }}
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
                  <th>Valor</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="plan in planes" :key="plan.id">
                  <td>{{ plan.nombre }}</td>
                  <td>{{ plan.descripcion }}</td>
                  <td>{{ plan.valor }}</td>
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
import $ from "jquery";

export default {
  data() {
    return {
      plan: {
        id: 0,
        nombre: "yy",
        descripcion: "yuu",
        valor: 0,
      },
      id: 0,
      modificar: true,
      modal: 0,
      tituloModal: "",
      planes: [],
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
    getPlanes: function () {
      $.noConflict();
      var url = "/admin/planes";
      axios.get(url).then((res) => {
        this.planes = res.data;
        $("#sampleTable").DataTable().destroy();
        this.table();
      });
    },
    async eliminar(plan) {
      swal({
        title: "Estas seguro de eliminar el plan " + plan.nombre + "?",
        text: "Una vez eliminado no lo podras recuperar!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      }).then((willDelete) => {
        if (willDelete) {
          let url = "/admin/planes/" + plan.id;
          axios
            .delete(url)
            .then((res) => {
              this.getPlanes();
              swal("Exito!", "Plan eliminado correctamente", "success");
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
        let url = "/admin/planes/" + this.id;
        axios
          .put(url, this.plan)
          .then((res) => {
            console.log(res);
            this.getPlanes();
            this.cerrarModal();
            swal("Exito!", "Usuario editado correctamente", "success");
          })
          .catch((e) => {
            this.errores = e.response.data.errors;
          });
      } else {
        let url = "/admin/planes/";
        axios
          .post(url, this.plan)
          .then((res) => {
            this.id = "";
            this.getPlanes();
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
        this.tituloModal = "Modificar plan";
        this.plan.nombre = data.nombre;
        this.plan.descripcion = data.descripcion;
        this.plan.valor = data.valor;
      } else {
        this.id = 0;
        this.tituloModal = "Crear plan";
        this.plan.nombre = "";
        this.plan.descripcion = "";
        this.plan.valor = 1;
      }
    },
    cerrarModal() {
      this.modal = 0;
      this.errores = {};
    },
  },
  created() {
    this.getPlanes();
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