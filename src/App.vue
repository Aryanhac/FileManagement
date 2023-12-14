<template>
  <div id="file-management">
    <div>
      <h1>File Management</h1>
      <input type="file" @change="handleFileChange" />
      <button @click="uploadFile">Upload File</button>
      <ul>
        <li v-for="file in files" :key="file.id">
          {{ file.name }}
          <button @click="downloadFile(file.id)">Download</button>
          <button @click="viewFile(file.id)">View</button>
          <button @click="deleteFile(file.id)">Delete</button>
        </li>
      </ul>
    </div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  data() {
    return {
      files: [],
      uploadedFile: null,
    };
  },
  mounted() {
    this.getFiles();
  },
  methods: {
    handleFileChange(event) {
      this.uploadedFile = event.target.files[0];
    },
    uploadFile() {
      const formData = new FormData();
      formData.append("file", this.uploadedFile);

      axios
        .post("/apps/filemanagement/upload", formData)
        .then((response) => {
          this.uploadedFile = null;
          this.getFiles();
        })
        .catch((error) => console.error(error));
    },
    downloadFile(fileId) {
      axios
        .get(`/apps/filemanagement/download/${fileId}`, { responseType: "blob" })
        .then((response) => {
          // Handle the downloaded file (e.g., open/save it)
        })
        .catch((error) => console.error(error));
    },
    viewFile(fileId) {
      axios
        .get(`/apps/filemanagement/view/${fileId}`)
        .then((response) => {
          // Handle the file content (e.g., display it)
        })
        .catch((error) => console.error(error));
    },
    deleteFile(fileId) {
      axios
        .delete(`/apps/filemanagement/delete/${fileId}`)
        .then((response) => {
          this.getFiles();
        })
        .catch((error) => console.error(error));
    },
    getFiles() {
      axios
        .get("/apps/filemanagement/files")
        .then((response) => {
          this.files = response.data;
        })
        .catch((error) => console.error(error));
    },
  },
};
</script>

<style scoped>

</style>