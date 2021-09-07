<template>
  <div>
    <div class="d-flex flex-column-fluid">
      <div class="container">
        <div class="card card-custom">
          <div class="card-header flex-wrap border-0 pt-6 pb-0">
            <div class="card-title">
              <h3 class="card-label">Lista de ongs</h3>
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
              <div class="modal-dialog modal-dialog-scrollable" role="document">
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
                      <div class="my-2">
                        <label for="nombre">Nombre</label>
                        <input
                          v-model="ong.nombre"
                          type="text"
                          class="form-control"
                          id="nombre"
                          placeholder="Nombre de la ong"
                        />
                        <span class="text-danger" v-if="errores.nombre">
                          {{ errores.nombre[0] }}
                        </span>
                      </div>
                      <div class="my-2">
                        <label for="ciudad">ciudad</label>
                        <select
                          v-model="ong.ciudad"
                          class="
                            form-control form-control-lg form-control-solid
                          "
                        >
                          <option value="">Selecciones una ciudad...</option>
                          <option value="Santa Cruz">Santa Cruz</option>
                          <option value="La Paz">La Paz</option>
                          <option value="Cochabamba">Cochabamba</option>
                          <option value="Beni">Beni</option>
                          <option value="Pando">Pando</option>
                          <option value="Potosi">Potosi</option>
                          <option value="Oruro">Oruro</option>
                          <option value="Chuquisaca">Chuquisaca</option>
                          <option value="Tarija">Tarija</option>
                        </select>
                        <span class="text-danger" v-if="errores.ciudad">
                          {{ errores.ciudad[0] }}
                        </span>
                      </div>
                      <div class="my-2">
                        <label for="nit">Nit</label>
                        <input
                          v-model="ong.nit"
                          type="text"
                          class="form-control"
                          id="nit"
                          placeholder="nit de la ong"
                        />
                        <span class="text-danger" v-if="errores.nombre">
                          {{ errores.nombre[0] }}
                        </span>
                      </div>
                      <div class="my-2">
                        <label for="direccion">Direccion</label>
                        <input
                          v-model="ong.direccion"
                          type="text"
                          class="form-control"
                          id="direccion"
                          placeholder="Direccion de la ong"
                        />
                        <span class="text-danger" v-if="errores.nombre">
                          {{ errores.nombre[0] }}
                        </span>
                      </div>
                      <div class="my-2">
                        <label for="correo_institucional"
                          >Correo Institucional</label
                        >
                        <input
                          v-model="ong.correo_institucional"
                          type="text"
                          class="form-control"
                          id="correo_institucional"
                          placeholder="Correo Institucional de la ong"
                        />
                        <span class="text-danger" v-if="errores.nombre">
                          {{ errores.nombre[0] }}
                        </span>
                      </div>
                      <div class="my-2">
                        <label for="telefono">Telefono</label>
                        <input
                          v-model="ong.telefono"
                          type="number"
                          class="form-control"
                          id="telefono"
                          placeholder="Telefono de la ong"
                        />
                        <span class="text-danger" v-if="errores.nombre">
                          {{ errores.nombre[0] }}
                        </span>
                      </div>
                      <div class="my-2">
                        <label for="representante">Representante</label>
                        <input
                          v-model="ong.representante"
                          type="text"
                          class="form-control"
                          id="representante"
                          placeholder="Representante de la ong"
                        />
                        <span class="text-danger" v-if="errores.nombre">
                          {{ errores.nombre[0] }}
                        </span>
                      </div>
                      <div class="my-2">
                        <label for="correo_representante"
                          >Correo Representante</label
                        >
                        <input
                          v-model="ong.correo_representante"
                          type="text"
                          class="form-control"
                          id="correo_representante"
                          placeholder="Correo Representante de la ong"
                        />
                        <span class="text-danger" v-if="errores.nombre">
                          {{ errores.nombre[0] }}
                        </span>
                      </div>
                      <div class="my-2">
                        <label for="mision">Mision</label>
                        <textarea
                          v-model="ong.mision"
                          type="text"
                          class="form-control"
                          id="mision"
                          placeholder="Mision de la ong"
                        />
                        <span class="text-danger" v-if="errores.nombre">
                          {{ errores.nombre[0] }}
                        </span>
                      </div>
                      <div class="my-2">
                        <label for="vision">Vision</label>
                        <textarea
                          v-model="ong.vision"
                          type="text"
                          class="form-control"
                          id="vision"
                          placeholder="Vision de la ong"
                        />
                        <span class="text-danger" v-if="errores.nombre">
                          {{ errores.nombre[0] }}
                        </span>
                      </div>
                      <div class="my-2">
                        <label for="cuenta_banco">cuenta_banco</label>
                        <input
                          v-model="ong.cuenta_banco"
                          type="text"
                          class="form-control"
                          id="cuenta_banco"
                          placeholder="cuenta_banco de la ong"
                        />
                        <span class="text-danger" v-if="errores.nombre">
                          {{ errores.nombre[0] }}
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
                  <th>Ciudad</th>
                  <th>Correo Institucional</th>
                  <th>Telefono</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="ong in ongs" :key="ong.id">
                  <td>
                    <img
                      v-bind:src="
                        'https://wipem.sfo3.digitaloceanspaces.com/' + ong.logo
                      "
                      width="50"
                      height="50"
                    />
                  </td>
                  <td>{{ ong.nombre }}</td>
                  <td>{{ ong.ciudad }}</td>
                  <td>{{ ong.correo_institucional }}</td>
                  <td>{{ ong.telefono }}</td>
                  <td>
                    <button
                      @click="
                        modificar = true;
                        abrirModal(ong);
                      "
                      class="btn btn-warning"
                    >
                      <i class="fas fa-edit"> </i>
                    </button>
                    <button @click="eliminar(ong)" class="btn btn-danger">
                      <i class="fas fa-trash"> </i>
                    </button>
                    <button @click="subong()" class="btn btn-success">
                      <i class="fas fa-info-circle"> </i>
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
      ong: {
        id: 0,
        nombre: "",
        ciudad: "",
        nit: "",
        direccion: "",
        telefono: 0,
        correo_institucional: "",
        representante: "",
        correo_representante: "",
        mision: "",
        vision: "",
        logo: "",
        cuenta_banco: "",
      },
      id: 0,
      modificar: true,
      modal: 0,
      tituloModal: "",
      ongs: [],
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
      axios.post("/uploadOng", formData).then((res) => {
        this.ong.logo = res.data;
        this.guardar();
        $("#formId")[0].reset();
      });
    },
    getOngs: function () {
      $.noConflict();
      var url = "/admin/ongs";
      axios.get(url).then((res) => {
        this.ongs = res.data;
        $("#sampleTable").DataTable().destroy();
        this.table();
      });
    },
    async eliminar(ong) {
      swal({
        title: "Estas seguro de eliminar la ong " + ong.nombre + "?",
        text: "Una vez eliminado no lo podras recuperar!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      }).then((willDelete) => {
        if (willDelete) {
          let url = "/admin/ongs/" + ong.id;
          axios
            .delete(url)
            .then((res) => {
              this.getOngs();
              swal("Exito!", "Usuario eliminado correctamente", "success");
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
        let url = "/admin/ongs/" + this.id;
        axios
          .put(url, this.ong)
          .then((res) => {
            console.log(res);
            this.getOngs();
            this.cerrarModal();
            swal("Exito!", "Usuario editado correctamente", "success");
          })
          .catch((e) => {
            this.errores = e.response.data.errors;
          });
      } else {
        let url = "/admin/ongs/";
        axios
          .post(url, this.ong)
          .then((res) => {
            this.id = "";
            this.getOngs();
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
        this.tituloModal = "Modificar ong";
        this.ong.nombre = data.nombre;
        this.ong.ciudad = data.ciudad;
        this.ong.nit = data.nit;
        this.ong.direccion = data.direccion;
        this.ong.telefono = data.telefono;
        this.ong.correo_institucional = data.correo_institucional;
        this.ong.representante = data.representante;
        this.ong.correo_representante = data.correo_representante;
        this.ong.mision = data.mision;
        this.ong.vision = data.vision;
        this.ong.logo = data.logo;
        this.ong.cuenta_banco = data.cuenta_banco;
      } else {
        this.id = 0;
        this.tituloModal = "Crear ong";
        this.ong.nombre = "";
        this.ong.ciudad = "";
        this.ong.nit = "";
        this.ong.direccion = "";
        this.ong.telefono = 0;
        this.ong.correo_institucional = "";
        this.ong.representante = "";
        this.ong.correo_representante = "";
        this.ong.mision = "";
        this.ong.vision = "";
        this.ong.logo = "";
        this.ong.cuenta_banco = "";
      }
    },
    cerrarModal() {
      this.modal = 0;
      this.errores = {};
    },
  },
  created() {
    this.getOngs();
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