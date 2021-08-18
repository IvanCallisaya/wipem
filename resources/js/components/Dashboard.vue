<template>
  <form id="formId" @submit.prevent="upload">
    <input @change="handleOnChange" type="file" />
    <button>Cargar</button>
  </form>
</template>

<script>
export default {
  data: () => ({
    image: "",
    path: "",
  }),
  methods: {
    handleOnChange(e) {
      this.image = e.target.files[0];
      console.log(this.image);
    },
    upload(e) {
      const formData = new FormData();
      formData.set("image", this.image);
      console.log(formData);
      axios.post("/uploadOng", formData).then((res) => {
        this.path = res.data;
        console.log(this.path);
        $("#formId")[0].reset();
      });
    },
  },
  mounted() {
    console.log("Component mounted.");
  },
};
</script>
