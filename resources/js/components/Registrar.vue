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
                    v-model="user.name"
                    placeholder="Nombre"
                    type="text"
                  />
                  <input
                    v-model="donador.apellido"
                    placeholder="Apellido"
                    type="email"
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
                      @click="obtener()"
                      type="button"
                      class="btn-primary"
                    >
                      Registrarse
                    </button>
                  </div>
                </div>
              </form>
              <div class="gap-30"></div>
              <div class="container pie-formulario col-md-12">
                <div class="col-md-6 text-center">
                  <p>¿Ya tienes una cuenta?</p>
                </div>
                <div class="col-md-6 text-center">
                  <a href="">Iniciar Sesión</a>
                </div>
                <div class="col-md-12 text-center">
                  <p>Registrarse con</p>
                </div>
                <div class="col-md-12 text-center">
                  <ul>
                    <li>
                      <a href=""
                        ><img
                          src="images/icons/facebook.png"
                          class="img-responsive"
                          alt=""
                      /></a>
                    </li>
                    <li>
                      <a href=""
                        ><img
                          src="images/icons/google.png"
                          class="img-responsive"
                          alt=""
                      /></a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    <pre> {{ donador }} {{ codigo}}  {{ user }}  </pre>
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
            axios.get(`usuario/${this.user.email}`).then(res => {
            console.log(res.data.id);
            this.donador.user_id = res.data.id;
            this.donador.celular= this.codigo+ " " +this.donador.celular;
            
            })
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
