<template>
  <div>
    <div class="container">
      <div class="heading-3">
        <h5 class="text-center text-uppercase">{{ proyecto.nombre }}</h5>
      </div>
      <div class="container">
        <div class="modal" :class="{ mostrar: modal }">
          <div class="modal-dialog">
            <div class="modal-content">
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
              <div class="modal-body">
                <form id="FormCliente">
                  <div class="my-4">
                    <label for=""> Proyecto: </label>
                    <input
                      type="text"
                      name="Proyecto"
                      :value="pago_id"
                      class="form-control"
                    />
                  </div>
                  <div class="my-4">
                    <label for=""> Email: </label>
                    <input
                      type="text"
                      name="Email"
                      :value="email"
                      class="form-control"
                    />
                  </div>
                  <div class="my-4">
                    <label for=""> Celular: </label>
                    <input
                      type="number"
                      name="Celular"
                      :value="celular"
                      class="form-control"
                    />
                  </div>
                  <div class="my-4">
                    <label for=""> Monto: </label>
                    <input
                      v-model="pago.monto"
                      type="number"
                      name="Monto"
                      value="1"
                      class="form-control"
                    />
                  </div>
                  <div class="my-4">
                    <label for=""> Proyecto: </label>

                    <input
                      type="text"
                      name="slug"
                      :value="proyecto.slug"
                      class="form-control"
                    />
                  </div>
                  <div class="my-4">
                    <label for=""> MonedaVenta: </label>
                    <select name="MonedaVenta" id="" class="form-control">
                      <option value="2">Bs</option>
                    </select>
                  </div>
                </form>
              </div>

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
                  @click="donar()"
                  type="button"
                  class="btn btn-success"
                  data-dismiss="modal"
                >
                  Donar
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row justify-content-md-center">
        <div class="col-md-12 col-lg-12 gap-30">
          <div class="donation-causes dc-single">
            <div class="col-md-7 col-lg-8 col-sm-7 col-xs-5 group">
              <div>
                <div class="progressBarRow col-lg-8 col-md-8 col-sm-8 col-xs-7">
                  <div class="row m0">
                    <div class="progress_barBox row m0">
                      <div class="progress">
                        <div
                          class="progress-bar"
                          role="progressbar"
                          aria-valuenow="5000"
                          aria-valuemin="0"
                          aria-valuemax="100"
                          :style="{ width: porcentaje + '%' }"
                        >
                          <div class="percentage">
                            <span class="counter">{{ porcentaje }}</span
                            >%
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="fund_raises style2 row m0">
                      <div class="col-xs-6 amount_box_raised">
                        <h6>recaudado</h6>
                        <h3>{{ proyecto.recaudado }}</h3>
                      </div>
                      <div class="col-xs-6 amount_box_goal">
                        <h6>objetivo</h6>
                        <h3>{{ proyecto.objetivo }}</h3>
                      </div>
                    </div>
                  </div>
                </div>
                <div
                  class="
                    col-lg-3 col-md-3 col-sm-3 col-xs-5
                    sidebar
                    cause-sidebar
                  "
                >
                  <div class="row m0 widget widget-category">
                    <a @click="abrirModal()" class="btn-primary_cause"
                      >DONE AHORA</a
                    >
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-12 col-xs-12">
              <div class="embed-responsive embed-responsive-16by9">
                <iframe
                  style="border-radius: 9px"
                  :src="proyecto.video"
                  frameborder="0"
                  allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                  allowfullscreen
                ></iframe>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="container parrafo_container">
      <p class="parrafo" v-html="proyecto.descripcion"></p>
    </div>
    <div class="container">
      <div class="row footer_sidebar">
        <div class="widget widget-about col-sm-6 col-md-4">
          <div class="item">
            <img
              :src="'https://wipem.sfo3.digitaloceanspaces.com/' + ong.logo"
              alt=""
            />
          </div>
        </div>
        <div class="widget widget-contact col-sm-6 col-md-4">
          <h6 class="label label-default widget-title">MISIÓN</h6>
          <address>
            {{ ong.vision }}
          </address>
        </div>
        <div class="widget widget-contact col-sm-6 col-md-4">
          <h6 class="label label-default widget-title">VISIÓN</h6>
          <address>
            {{ ong.mision }}
          </address>
        </div>
      </div>
    </div>
    <div class="container galeria_container">
      <div class="heading-3 gap-50">
        <h5 class="text-center">GALERÍA</h5>
      </div>
      <div class="influencer-slider">
        <div class="home-slider" v-if="proyecto !== null">
          <Slick ref="slick" :options="slickOptions">
            <div v-for="(imagen, index) in proyecto.fotos" :key="index">
              <div
                class="hs-inner-galeria embed-responsive embed-responsive-4by3"
                v-bind:style="{
                  backgroundImage:
                    'url(https://wipem.sfo3.digitaloceanspaces.com/' +
                    imagen +
                    ')',
                }"
              ></div>
            </div>
          </Slick>
        </div>
      </div>
    </div>
    <div class="container compartir heading-3 gap-30">
      <div class="text-center share-buttons-row">
        <h5 class="text-uppercase">Compartir:</h5>
        <ShareNetwork
          network="facebook"
          v-bind:title="this.proyecto.nombre"
          v-bind:description="this.proyecto.resumen_principal"
          v-bind:quote="
            this.proyecto.nombre + '\n' + this.proyecto.resumen_principal
          "
          v-bind:url="'https://wipem.com.bo/proyecto/' + this.proyecto.slug"
          v-bind:image="'https://wipem.com.bo/proyecto/' + proyecto.foto"
          v-bind:hashtags="'wipem, hola'"
        >
          <div class="share-fb"></div>
        </ShareNetwork>
        <ShareNetwork
          network="twitter"
          v-bind:title="
            this.proyecto.nombre + '\n' + this.proyecto.resumen_principal
          "
          v-bind:description="this.proyecto.resumen_principal"
          v-bind:quote="
            this.proyecto.nombre + '\n' + this.proyecto.resumen_principal
          "
          v-bind:url="'https://wipem.com.bo/proyecto/' + this.proyecto.slug"
          v-bind:image="'https://wipem.com.bo/proyecto/' + proyecto.foto"
          v-bind:hashtags="
            'wipem,' +
            this.proyecto.slug +
            ',' +
            this.proyecto.subcategoria.slug
          "
        >
          <div class="share-twitter"></div>
        </ShareNetwork>
        <ShareNetwork
          network="whatsapp"
          v-bind:title="this.proyecto.nombre"
          v-bind:description="this.proyecto.resumen_principal"
          v-bind:quote="
            this.proyecto.nombre + '\n' + this.proyecto.resumen_principal
          "
          v-bind:url="'https://wipem.com.bo/proyecto/' + this.proyecto.slug"
          v-bind:image="'https://wipem.com.bo/proyecto/' + proyecto.foto"
          v-bind:hashtags="'wipem,' + this.proyecto.slug"
        >
          <div class="share-whatsapp"><img src="/images/whatsapp.png" /></div>
        </ShareNetwork>
        <ShareNetwork
          network="linkedin"
          v-bind:title="this.proyecto.nombre"
          v-bind:description="this.proyecto.resumen_principal"
          v-bind:quote="
            this.proyecto.nombre + '\n' + this.proyecto.resumen_principal
          "
          v-bind:url="'https://wipem.com.bo/proyecto/' + this.proyecto.slug"
          v-bind:image="'https://wipem.com.bo/proyecto/' + proyecto.foto"
          v-bind:hashtags="'wipem,' + this.proyecto.slug"
        >
          <div class="share-linkedin"></div>
        </ShareNetwork>
        <ShareNetwork
          network="tumblr"
          v-bind:title="this.proyecto.nombre"
          v-bind:description="
            this.proyecto.nombre + '\n' + this.proyecto.resumen_principal
          "
          v-bind:quote="
            this.proyecto.nombre + '\n' + this.proyecto.resumen_principal
          "
          v-bind:url="'https://wipem.com.bo/proyecto/' + this.proyecto.slug"
          v-bind:image="'https://wipem.com.bo/proyecto/' + proyecto.foto"
          v-bind:hashtags="'wipem,' + this.proyecto.slug"
        >
          <div class="share-tumblr"></div>
        </ShareNetwork>
      </div>
    </div>
    <form
      method="post"
      id="FormPagoFacilCheckout"
      style="display: none"
      action="https://checkout.pagofacil.com.bo/es/pay"
      enctype="multipart/form-data"
      class="form"
    >
      <input name="tcParametros" id="tcParametros" type="text" value="" />
      <input name="tcCommerceID" id="tcCommerceID" type="text" value="" />
      <input type="submit" class="btn btn-primary" id="btnpagar" value="" />
    </form>
  </div>
</template>
<script>
import Slick from "vue-slick";
import "slick-carousel/slick/slick.css";
export default {
  metaInfo() {
    return {
      title: "Proyecto " + this.proyecto.nombre + " | Wipem",
      meta: [
        { name: "description", content: this.proyecto.resumen_principal },
        { name: "author", content: this.ong.nombre },
        { property: "og:local", content: "es_ES" },
        { property: "og:type", content: "website" },
      ],
    };
  },
  components: { Slick },
  props: ["proyecto"],

  data() {
    return {
      overriddenNetworks: {
        custom: {
          sharer: "https://mycustomdomain.com",
          type: "popup",
        },
      },
      pago_id: 0,
      pago: {
        donador_id: 0,
        proyecto_id: 0,
        estado: "",
        monto: 1,
        moneda: "Bs",
        fecha: "",
        metodo_pago: " ",
        fecha_confirmacion: "",
        fecha_pago: "",
      },
      tituloModal: "",
      email: "",
      celular: "",
      monto: "",
      moneda: "",
      idPago: "",
      idUsuario: 0,
      empresas: [],
      ong: {},
      imagenes: [],
      porcentaje: 0,
      modal: 0,
      article: encodeURIComponent(window.location.href),
      slickOptions: {
        arrows: false,
        infinite: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        dots: true,
        autoplay: true,
        autoplaySpeed: 4000,
      },
    };
  },
  methods: {
    getEmpresas: function () {
      var url = "ongs/" + this.proyecto.ong_id;

      axios.get(url).then((res) => {
        this.ong = res.data;
      });

      let objetivo = this.reverseFormatNumber(this.proyecto.objetivo, "de");
      let recaudado = this.reverseFormatNumber(this.proyecto.recaudado, "de");

      console.log(objetivo);
      console.log(recaudado);
      if (recaudado !== 0) {
        this.porcentaje = (recaudado * 100) / objetivo;
      } else {
        this.porcentaje = 0;
      }
      this.porcentaje = Math.round(this.porcentaje);
      console.log(this.porcentaje);
    },
    reverseFormatNumber: function (val, locale) {
      var group = new Intl.NumberFormat(locale).format(1111).replace(/1/g, "");
      var decimal = new Intl.NumberFormat(locale).format(1.1).replace(/1/g, "");
      var reversedVal = val.replace(new RegExp("\\" + group, "g"), "");
      reversedVal = reversedVal.replace(new RegExp("\\" + decimal, "g"), ".");
      return Number.isNaN(reversedVal) ? 0 : reversedVal;
    },
    compartirFacebook: function () {
      this.open_window(
        "http://www.facebook.com/sharer/sharer.php?u=" + this.article,
        "facebook_share"
      );
    },
    compartirTwitter: function () {
      window.open(
        "http://twitter.com/share?url=" + this.article,
        "twitter_share"
      );
    },
    compartirLinkedin: function () {
      this.open_window(
        "https://www.linkedin.com/shareArticle?mini=true&url=" +
          this.article +
          "&title=" +
          this.proyecto.nombre +
          "&summary=&source=",
        "linkedin_share"
      );
    },
    compartirTumblr: function () {
      this.open_window(
        "http://www.tumblr.com/share/link?url=" +
          this.article +
          "&name=" +
          this.proyecto.nombre +
          "&description=" +
          this.proyecto.resumen_principal,
        "tumblr_share"
      );
    },
    compartirWhatsapp: function () {
      this.open_window("https://api.whatsapp.com/send?text=" + this.article);
    },
    open_window: function (url, name) {
      window.open(
        url,
        name,
        "height=320, width=640, toolbar=no, menubar=no, scrollbars=yes, resizable=yes, location=no, directories=no, status=no"
      );
    },
    abrirModal() {
      if (this.email == "") {
        alert("Debe registrarse en el sistema por favor");
      } else {
        this.modal = 1;
        if (this.modificar) {
          this.tituloModal = "Donar";
          this.idPago = uuid.v1();
          this.email = "";
          this.celular = "";
          this.monto = "";
          this.moneda = "";
        }
      }
    },
    cerrarModal() {
      this.modal = 0;
    },
    pagar() {
      // se manda los datos del FormCliente ara que realize la encriptacion y devuelva
      //los datos para el FormPagoFacil
      // aqui se obtiene todo el Formulario del cliente en la variable loFormularioCliente
      var goFormularioCliente = $("#FormCliente").serialize();
      console.log(goFormularioCliente);
      // esta es la url que se mandaran los
      var lcUrlajax = "PagoFacilCheckoutEncript";

      //////esta parte es aplicado solo para proyecto hechos en laravel
      // ya que pide u token para pode r llamar a una ruta
      $.ajaxSetup({
        headers: {
          "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
      });
      $.ajax({
        url: lcUrlajax,
        data: { goFormularioCliente },
        type: "POST",
        dataType: "json",
        beforeSend: function () {
          //console.log(goFormularioCliente);
        },
        success: function (response) {
          //console.log(goFormularioCliente);
          console.log("Exito");
          console.log(response);

          $("#tcParametros").val(response.tcParametros);
          $("#tcCommerceID").val(response.tcCommerceID);
          $("#btnpagar").click();
        },
        error: function (data) {
          console.log("Error");
          console.log(data.responseText);
        },
      });
    },
    obtener() {
      this.pago.proyecto_id = this.proyecto.id;
      axios.get(`usuario/${this.email}`).then((res) => {
        this.idUsuario = res.data.id;
        this.donador();
      });
    },
    donador() {
      axios.get(`donadores/${this.idUsuario}`).then((res) => {
        this.celular = res.data.celular.substr(
          res.data.celular.indexOf(" ") + 1
        );
        this.pago.donador_id = res.data.id;
        this.celular = this.codigo + " " + this.donador.celular;
      });
    },
    donar() {
      this.pago.estado = "1";
      var today = new Date();
      this.pago.fecha = `${today.getFullYear()}-${
        today.getMonth() + 1
      }-${today.getDate()}`;
      let url = "/pago_proyecto";
      axios
        .post(url, this.pago)
        .then((res) => {
          this.pago_id = res.data.id;
          this.pagar();
        })
        .catch((e) => {
          this.errores = e.response.data.errors;
        });
    },
  },

  mounted() {
    this.getEmpresas();
    this.email = this.$userId;
    console.log(this.$userId);
    this.obtener();
  },
};
</script>
