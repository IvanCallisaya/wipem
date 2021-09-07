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
    <h3 class="text-center">Imagenes de la pagina principal</h3>
    <form id="formId" @submit.prevent="guardar">
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

    <table class="table table-striped my-4" v-if="pictures.length >= 1">
      <thead>
        <tr>
          <th scope="col">Imagenes</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(picture, index) in pictures" :key="index">
          <td class="border px-4 py-2 flex flex-wrap justify-center">
            <img
              class="px-4 py-2 m-2"
              v-for="(img, index) in picture.images"
              :key="index"
              :src="'https://wipem.sfo3.digitaloceanspaces.com/' + img"
              width="200px"
              height="100px"
            />
          </td>
          <td class="border px-4 py-2 text-center">
            <button @click="deleteImage(picture.id)" class="btn btn-danger">
              <i class="fas fa-trash"> </i>
            </button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>



<script>
export default {
  data: () => ({
    imagenes: [],
    pictures: "",
  }),
  methods: {
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
          self.getImages();
        })
        .catch((err) => {
          console.log(err);
        });
    },
    getImages() {
      axios
        .get("admin/imagenes")
        .then((response) => {
          this.pictures = response.data.images;
        })
        .catch((err) => {
          console.log(err);
        });
    },
    deleteImage(id) {
      axios
        .delete(`admin/imagenes/${id}`)
        .then((response) => {
          this.getImages();
        })
        .catch((err) => {
          console.log(err);
        });
    },
  },
  mounted() {
    console.log("Component mounted.");
  },
  created() {
    this.getImages();
  },
};
</script>
