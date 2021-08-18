<template>
  <div>
    <h1 class="text-center">Gestionar Articulos</h1>
    <hr />

    <!-- Button to Open the Modal -->
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

    <!-- The Modal -->
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
                v-model="articulo.nombre"
                type="text"
                class="form-control"
                id="nombre"
                placeholder="Nombre del Articulo"
              />
              <span class="text-danger" v-if="errores.nombre">
                {{ errores.nombre[0] }}
              </span>
            </div>

            <div class="my-4">
              <label for="description">description</label>
              <input
                v-model="articulo.description"
                type="text"
                class="form-control"
                id="description"
                placeholder="description del Articulo"
              />
              <span class="text-danger" v-if="errores.description">
                {{ errores.description[0] }}
              </span>
            </div>
            <div class="my-4">
              <label for="stock">stock</label>
              <input
                v-model="articulo.stock"
                type="number"
                class="form-control"
                id="stock"
                placeholder="Stock del Articulo"
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

    <table class="table table-striped">
      <thead class="thead-dark">
        <tr>
          <th scope="col">#</th>
          <th scope="col">Nombre</th>
          <th scope="col">description</th>
          <th scope="col">Stock</th>
          <th scope="col" colspan="2" class="text-center">Accion</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="art in articulos" :key="art.id">
          <th scope="row">{{ art.id }}</th>
          <td>{{ art.nombre }}</td>
          <td>{{ art.description }}</td>
          <td>{{ art.stock }}</td>
          <td>
            <button
              @click="
                modificar = true;
                abrirModal(art);
              "
              class="btn btn-warning"
            >
              Editar
            </button>
          </td>
          <td>
            <button @click="eliminar(art.id)" class="btn btn-danger">
              Eliminar
            </button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
export default {
  data() {
    return {
      articulo: {
        nombre: "yy",
        description: "yuu",
        stock: 1,
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
    async listar() {
      const res = await axios.get("/articulos");
      this.articulos = res.data;
    },
    async eliminar(id) {
      const res = await axios.delete("/articulos/" + id);
      this.listar();
    },
    async guardar() {
      try {
        if (this.modificar) {
          const res = await axios.put("/articulos/" + this.id, this.articulo);
        } else {
          const res = await axios.post("/articulos", this.articulo);
        }
        this.cerrarModal();
        this.listar();
      } catch (error) {
        if (error) {
          this.errores = error.response.data.errors;
        }
      }
    },
    abrirModal(data = {}) {
      this.modal = 1;
      if (this.modificar) {
        this.id = data.id;
        this.tituloModal = "Modificar Articulo";
        this.articulo.nombre = data.nombre;
        this.articulo.description = data.description;
        this.articulo.stock = data.stock;
      } else {
        this.id = 0;
        this.tituloModal = "Crear Articulo";
        this.articulo.nombre = "";
        this.articulo.description = "";
        this.articulo.stock = 1;
      }
    },
    cerrarModal() {
      this.modal = 0;
      this.errores={};
    },
  },
  created() {
    this.listar();
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