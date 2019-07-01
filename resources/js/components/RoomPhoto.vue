<template>
  <div class="card-box txt-full-width is-dirty is-upgraded">
    <div class="card-header d-flex justify-content-between">
      <div class="card-header--content">Room Photos</div>
      <div class="image--add">
        <!-- Button trigger modal -->
        <button
          type="button"
          class="btn btn-primary"
          data-toggle="modal"
          data-target="#image--model__add"
        >Add Images</button>
        <!-- Modal -->
        <div
          class="modal fade"
          id="image--model__add"
          tabindex="-1"
          role="dialog"
          aria-labelledby="modalLongTitle"
          aria-hidden="true"
        >
          <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">Upload Room Photos</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="col-lg-12 p-t-20">
                  <div id="id_dropzone" class="d-flex justify-content-center dz-clickable">
                    <div class="dz-message">
                      <div class="dropIcon">
                        <i class="material-icons">cloud_upload</i>
                        <input type="file" multiple>
                      </div>
                      <h3>Drop files here or click to upload.</h3>
                    </div>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button
                  type="button"
                  class="btn btn-primary"
                  data-dismiss="modal"
                  @click="getListImages()"
                >BACK</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="card-body">
      <div class="row">
        <div
          class="col-sm-4 text-sm-center"
          v-for="(image, index) in listImages"
          v-bind:key="image.id"
        >
          <div class="image-room">
            <img :src="asset(image.file_name)" :alt="image.original_name">
          </div>
          <a @click="deleteImage(image.id,index)" class="image--remove">Remove</a>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      listImages: [],
      roomId: null,
      hostName: null
    };
  },
  created() {
    this.roomId = document.getElementById("js_room_id").value;
    this.getListImages();
    this.hostName = window.location.origin;
    console.log(this.hostname);
  },
  methods: {
    getListImages() {
      axios
        .get("/api/list-images/" + this.roomId)
        .then(response => {
          this.listImages = response.data;
        })
        .catch(error => {
          console.error(error);
        });
    },
    deleteImage(imageId, index) {
      axios
        .delete(this.hostName + "/api/delete-image/" + imageId)
        .then(res => {
          this.listImages.splice(index, 1);
          console.log(res);
        })
        .catch(err => {
          console.error(err);
        });
    },
    asset(fileName) {
      return this.hostName + "/" + fileName;
    }
  }
};
</script>
<style>
    .image--remove{
        color: #337ab7 !important;
    }
    .image--remove:hover{
        text-decoration:underline !important;
    }
</style>
