<template>
  <div>
    <div class="inner-content">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="clearfix"></div>
            <div class="gap-60"></div>

            <div class="donors-list post-review make-donation">
              <h2 class="text-center">Registrarse</h2>

              <div class="clearfix"></div>
              <div class="gap-40"></div>
              <form>
                <div class="form-causes">
                  <input
                    v-model="donador.nombre"
                    placeholder="Nombre"
                    type="text"
                  />
                  <input
                    v-model="donador.apellido"
                    placeholder="Apellido"
                    type="text"
                  />
                  <div>
                    <div class="col-md-1 celular">
                      <vue-country-code
                        @onSelect="onSelect"
                        :preferredCountries="['bo', 'pe', 'us']"
                      >
                      </vue-country-code>
                    </div>
                    <div class="col-md-11 celular">
                      <input
                        v-model="donador.celular"
                        placeholder="Celular"
                        type="text"
                      />
                    </div>
                  </div>
                  <input
                    v-model="user.email"
                    placeholder="Correo"
                    type="email"
                  />
                  <input
                    v-model="user.password"
                    placeholder="Contraseña"
                    type="password"
                  />
                  <input
                    v-model="user.password_confirmation"
                    placeholder="Repetir Contraseña"
                    type="password"
                  />

                  <div class="col-md-12 text-center">
                    <button
                      @click="registrar()"
                      type="button"
                      class="btn-primary"
                    >
                      Registrarse
                    </button>
                  </div>
                </div>
              </form>
            </div>
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
      donador: {
        nombre: "",
        apellido: "",
        celular: "",
        user_id: 0,
      },
      user: {
        name: "",
        email: "",
        password: "",
        password_confirmation: "",
      },
      codigo: "",
      repetir: "",
    };
  },
  methods: {
    registrar() {
      this.user.name = this.donador.nombre + " " + this.donador.apellido;
      let url = "/register";
      axios
        .post(url, this.user)
        .then((res) => {
          this.obtener();
        })
        .catch((e) => {
          this.errores = e.response.data.errors;
        });
    },
    obtener() {
      axios.get(`usuario/${this.user.email}`).then((res) => {
        console.log(res.data.id);
        this.donador.user_id = res.data.id;
        this.donador.celular = this.codigo + " " + this.donador.celular;
        this.guardar();
      });
    },
    guardar() {
      let url = "/donadores";
      axios
        .post(url, this.donador)
        .then((res) => {
          window.open("/login#", "_self");
        })
        .catch((e) => {
          this.errores = e.response.data.errors;
        });
    },
    onSelect({ name, iso2, dialCode }) {
      console.log(name, iso2, dialCode);
      this.codigo = "+" + dialCode;
    },
  },
  mounted() {},
};
</script>

<style>
.celular {
  padding: 0;
}
</style>
