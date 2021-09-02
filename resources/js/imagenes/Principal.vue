<template>
  <div class="container mx-auto bg-white">
    <!-- <div>
      <input
        @change="imageChange"
        class="hidden my-4"
        type="file"
        name="image"
        ref="files"
        multiple
      />
    </div>
    <div>
      <p class="my-0" v-for="(image, index) in imagenes" :key="index">
        {{ image.name }}
      </p>
    </div>
    <div class="flex items-center justify-between m-auto">
      <button @click="uploadimagenes" class="btn btn-primary">Upload</button>
    </div> -->

    <form id="formId" @submit.prevent="guardar">
      <div class="my-2">
        <label class="mr-4" for="imagen">Seleccion imagen del influencer</label>
        <input @change="handleOnChange" type="file" id="imagen" />
      </div>
      <div>
        <label class="mr-4" for="imagenes">Imagenes</label>
        <input
          @change="imageChange"
          class="hidden my-4"
          type="file"
          name="image"
          ref="files"
          multiple
        />
      </div>
      <div>
        <p class="my-0" v-for="(image, index) in imagenes" :key="index">
          {{ image.name }}
        </p>
      </div>

      <button class="btn btn-success">Guardar</button>
      <button class="btn btn-secondary">Cancelar</button>
    </form>
  </div>
</template>
  </div>

  
</template>


<script>
export default {
  data: () => ({
    imagenes: [],
    imagen: "",
  }),
  methods: {
    handleOnChange(e) {
      this.imagen = e.target.files[0];
      console.log(this.image);
    },
    imageChange() {
      for (let i = 0; i < this.$refs.files.files.length; i++) {
        this.imagenes.push(this.$refs.files.files[i]);
        console.log(this.imagenes);
      }
    },
    guardar() {
      var self = this;
      let formData = new FormData();
      for (let i = 0; i < this.imagenes.length; i++) {
        let file = self.imagenes[i];
        formData.append("files[" + i + "]", file);
      }
      formData.set("imagen", this.imagen);
      console.log(formData);
      const config = {
        header: { "content-type": "multipart/form-data" },
      };

      axios
        .post("admin/imagenes", formData, config)
        .then((response) => {
          console.log(response);

          self.$refs.files.value = "";
          self.imagenes = [];
        })
        .catch((err) => {
          console.log(error);
        });
    },
  },
  mounted() {
    console.log("Component mounted.");
  },
};
</script>
