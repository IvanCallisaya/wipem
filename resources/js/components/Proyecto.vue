<template>
  <div>
    <div class="container">
      <div class="heading-3 gap-50">
        <h5 class="text-center text-uppercase">{{ proyecto.nombre }}</h5>
      </div>

      <div class="row justify-content-md-center">
        <div class="col-md-12 col-lg-12">
          <div class="donation-causes dc-single">
            <div class="col-md-7 col-lg-8 col-sm-7 col-xs-5 group">
              <div>
                <div class="progressBarRow col-lg-7 col-md-7 col-sm-7 col-xs-6">
                  <div class="row m0">
                    <div class="progress_barBox row m0">
                      <div class="progress">
                        <div
                          class="progress-bar"
                          role="progressbar"
                          aria-valuenow="68"
                          aria-valuemin="0"
                          aria-valuemax="100"
                        >
                          <div class="percentage">
                            <span class="counter">68</span>%
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="fund_raises style2 row m0">
                      <div class="col-xs-6 amount_box_raised">
                        <h6>recaudado</h6>
                        <h3>$65,360</h3>
                      </div>
                      <div class="col-xs-6 amount_box_goal">
                        <h6>objetivo</h6>
                        <h3>{{ proyecto.objetivo }}</h3>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 sidebar cause-sidebar">
                  <div class="row m0 widget widget-category">
                    <a href="#donate_box" class="btn-primary_cause"
                      >DONE AHORA</a
                    >
                  </div>
                </div>
              </div>
            </div>

            <iframe height="400" :src="proyecto.video"> </iframe>

            <div class="gap-40"></div>

            <p v-html="proyecto.descripcion"></p>
          </div>
        </div>
      </div>
    </div>

    <div class="container">
      <div class="row footer_sidebar">
        <div class="widget widget-about col-sm-6 col-md-4">
          <div class="item">
            <img :src="ong.logo" alt="" />
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
        <div class="home-slider">
          <div
            v-for="(imagen, index) in proyecto.fotos"
            :key="index"
            class="hs-inner-galeria"
            v-bind:style="{
              backgroundImage:
                'url(http://localhost:8000/storage/' + imagen + ')',
            }"
          ></div>
        </div>
      </div>
    </div>

    <div class="inner-content">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="clearfix"></div>
            <div class="gap-60"></div>

            <div class="donors-list post-review make-donation">
              <h6 class="text-center">Hacer Donación:</h6>

              <div class="rbox-wrap">
                <div class="rbox2">
                  <input type="radio" checked="checked" id="r1" name="rbox2" />
                  <label for="r1">$10.00</label>
                </div>

                <div class="rbox2">
                  <input type="radio" id="r2" name="rbox2" />
                  <label for="r2">$25.00</label>
                </div>

                <div class="rbox2">
                  <input type="radio" id="r3" name="rbox2" />
                  <label for="r3">$50.00</label>
                </div>

                <div class="rbox2">
                  <input type="radio" id="r4" name="rbox2" />
                  <label for="r4">$75.00</label>
                </div>

                <div class="rbox2">
                  <input type="radio" id="r5" name="rbox2" />
                  <label for="r5">$100.00</label>
                </div>
              </div>

              <div class="clearfix"></div>
              <div class="gap-60"></div>

              <div class="cbox-wrap">
                <div class="cbox">
                  <input type="radio" id="c1" name="cbox" />
                  <label for="c1">Recuring</label>
                </div>

                <div class="cbox">
                  <input type="radio" id="c2" name="cbox" />
                  <label for="c2">Monthly</label>
                </div>
              </div>

              <div class="clearfix"></div>
              <div class="gap-40"></div>

              <form>
                <div class="form-causes">
                  <input placeholder="Appears on your card" type="text" />
                  <input placeholder="Your Email" type="email" />
                  <input placeholder="Phone Number" type="text" />
                  <input placeholder="Your Card Number" type="text" />
                  <textarea placeholder="Your Message"></textarea>
                  <div class="container bg-light">
                    <div class="col-md-8 text-center">
                      <button type="button" class="btn-primary">
                        Donar ahora
                      </button>
                    </div>
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
  props: ["proyecto"],

  data() {
    return {
      empresas: [],
      ong: {},
      imagenes: [],
    };
  },
  methods: {
    getEmpresas: function () {
      var url = "ongs/" + this.proyecto.ong_id;
      axios.get(url).then((res) => {
        this.ong = res.data;
      });
    },
   
    // getImagenes: function (imagenes) {
    //   for (let i = 0; i < imagenes.length; i++) {
    //     this.imagenes.push(categorias[i].subcategorias[j]);
    //   }
    // },
  },
  mounted() {
    this.getEmpresas();

  },
};
</script>
