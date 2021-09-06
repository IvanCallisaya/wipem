<template>
  <div>
    <div class="d-flex flex-column-fluid">
      <div class="container">
        <div class="card card-custom">
          <div class="card-header flex-wrap border-0 pt-6 pb-0">
            <div class="card-title">
              <h3 class="card-label">Lista de Influencers</h3>
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
                          v-model="sponsor.nombre"
                          type="text"
                          class="form-control"
                          id="nombre"
                          placeholder="Nombre de la sponsor"
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
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="sponsor in sponsors" :key="sponsor.id">
                  <td>
                    <img
                      v-bind:src="
                        'https://wipem.sfo3.digitaloceanspaces.com/' +
                        sponsor.logo
                      "
                      width="50"
                      height="50"
                    />
                  </td>
                  <td>{{ sponsor.nombre }}</td>
                  <td>
                    <button
                      @click="
                        modificar = true;
                        abrirModal(sponsor);
                      "
                      class="btn btn-warning"
                    >
                      <i class="fas fa-edit"> </i>
                    </button>

                    <button @click="eliminar(sponsor)" class="btn btn-danger">
                      <i class="fas fa-trash"> </i>
                    </button>
                    <router-link
                      :to="{
                        name: 'empresa',
                        params: { id: sponsor.id },
                      }"
                      class="btn btn-success"
                    >
                      <i class="fas fa-info-circle"> </i>
                    </router-link>
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
      sponsor: {
        id: 0,
        nombre: "",
        logo: "",
        tipo: this.$route.name,
      },
      id: 0,
      modificar: true,
      modal: 0,
      tituloModal: "",
      sponsors: [],
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
      axios.post("/uploadSponsor", formData).then((res) => {
        this.sponsor.logo = res.data;
        this.guardar();
        $("#formId")[0].reset();
      });
    },
    getsponsors: function () {
      $.noConflict();
      var url = "/admin/sponsor/" + this.$route.name;
      axios.get(url).then((res) => {
        this.sponsors = res.data;
        $("#sampleTable").DataTable().destroy();
        this.table();
      });
    },
    async eliminar(sponsor) {
      swal({
        title: "Estas seguro de eliminar al influencer " + sponsor.nombre + "?",
        text: "Una vez eliminado no lo podras recuperar!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      }).then((willDelete) => {
        if (willDelete) {
          let url = "/admin/sponsor/" + sponsor.id;
          axios
            .delete(url)
            .then((res) => {
              this.getsponsors();
              swal("Exito!", "Influencer eliminado correctamente", "success");
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
        let url = "/admin/sponsor/" + this.id;
        axios
          .put(url, this.sponsor)
          .then((res) => {
            console.log(res);
            this.getsponsors();
            this.cerrarModal();
            swal("Exito!", "Usuario editado correctamente", "success");
          })
          .catch((e) => {
            this.errores = e.response.data.errors;
          });
      } else {
        let url = "/admin/sponsor/" + this.$route.name;
        axios
          .post(url, this.sponsor)
          .then((res) => {
            this.id = "";
            this.getsponsors();
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
        this.tituloModal = "Modificar sponsor";
        this.sponsor.nombre = data.nombre;
      } else {
        this.id = 0;
        this.tituloModal = "Crear sponsor";
        this.sponsor.nombre = "";
      }
    },
    cerrarModal() {
      this.modal = 0;
      this.errores = {};
    },
  },
  created() {
    this.getsponsors();
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