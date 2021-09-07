<template>
  <div>
    <div class="d-flex flex-column-fluid">
      <div class="container-fluid">
        <div class="card card-custom">
          <div class="card-header flex-wrap border-0 pt-6 pb-0">
            <div class="card-title">
              <h3 class="card-label">Lista de Proyectos</h3>
            </div>
            <router-link to="/proyecto/nuevo" class="btn btn-primary my-4">
              Nuevo
            </router-link>
          </div>

          <table class="table table-hover table-bordered" id="sampleTable">
            <thead>
              <tr>
                <th>Imagen</th>
                <th>Nombre</th>
                <th>Resumen Principal</th>
                <th>Correo Institucional</th>
                <th>Destacado</th>
                <th>Fecha final</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="proyecto in proyectos" :key="proyecto.id">
                <td>
                  <img
                    v-bind:src="
                      'https://wipem.sfo3.digitaloceanspaces.com/' +
                      proyecto.foto_principal
                    "
                    width="50"
                    height="50"
                  />
                </td>
                <td>{{ proyecto.nombre }}</td>
                <td>{{ proyecto.resumen_principal }}</td>
                <td>{{ proyecto.objetivo }}</td>
                <td>
                  <p class="bg-success" v-if="proyecto.destacado">Destacado</p>
                  <p class="bg-danger" v-else>No destacado</p>
                </td>
                <td>{{ proyecto.fecha_final }}</td>
                <td>
                  <router-link
                    :to="{
                      name: 'proyectoEdit',
                      params: { id: proyecto.id },
                    }"
                    class="btn btn-warning"
                  >
                    <i class="fas fa-edit"> </i>
                  </router-link>
                  <button @click="eliminar(proyecto)" class="btn btn-danger">
                    <i class="fas fa-trash"> </i>
                  </button>
                  <router-link
                    :to="{
                      name: 'proyectoDetalle',
                      params: { id: proyecto.id },
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
</template>



<script>
import $ from "jquery";

export default {
  data() {
    return {
      id: 0,

      modal: 0,
      proyectos: [],
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
    getProyectos: function () {
      $.noConflict();
      var url = "/admin/proyectos";
      axios.get(url).then((res) => {
        this.proyectos = res.data;
        $("#sampleTable").DataTable().destroy();
        this.table();
      });
    },
    async eliminar(proyecto) {
      swal({
        title: "Estas seguro de eliminar el proyecto " + proyecto.nombre + "?",
        text: "Una vez eliminado no lo podras recuperar!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      }).then((willDelete) => {
        if (willDelete) {
          let url = "/admin/proyectos/" + proyecto.id;
          axios
            .delete(url)
            .then((res) => {
              this.getProyectos();
              swal("Exito!", "Proyecto eliminado correctamente", "success");
            })
            .catch((error) => {
              console.log(error);
              swal("Error!", "Intentelo de nuevo", "error");
            });
        }
      });
    },
  },
  mounted() {
    this.getProyectos();
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