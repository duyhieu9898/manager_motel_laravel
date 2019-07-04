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
                        <input type="file" multiple style="display:none">
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
          v-for="(image, index) in list_images"
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
    props: {
            room_id: {
                type: Number
            }
        },
    data() {
        return {
        list_images: [],
        host_name: null
        };
    },
    created() {
        this.host_name = window.location.origin;
        this.getListImages();

    },
    mounted(){
        const URL_PATH_UPLOAD = "/api/upload-image/"+this.room_id;
        var photo_counter = 0;

        var myDropzone = new Dropzone("#id_dropzone", {
            url: URL_PATH_UPLOAD,
            headers: {
                "X-CSRF-TOKEN": $('meta[name = "csrf-token"]').attr("content")
            },
            parallelUploads: 100,
            maxFiles: 1,
            maxFilesize: 5,
            acceptedFiles: ".jpeg,.jpg,.png,.gif",
            dictRemoveFile: "Remove",
            dictFileTooBig: "Image is bigger than 5MB",
            paramName: "file",
            // The setting up of the dropzone

            init: function() {},
            error: function(file, response) {
                if ($.type(response) === "string") var message = response;
                //dropzone sends it's own error messages in string
                else var message = response.message;

                file.previewElement.classList.add("dz-error");
                _ref = file.previewElement.querySelectorAll(
                    "[data-dz-errormessage]"
                );
                _results = [];
                for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                    node = _ref[_i];
                    _results.push((node.textContent = message));
                }
                console.log(_results);
                return _results;
            },
            success: function(file, res) {
                console.log(res);
                $("#debug").html(res);
                photo_counter++;
                $("#photoCounter").text("(" + photo_counter + ")");
            }
        });
    },
    methods: {
        getListImages() {
        axios
            .get(this.host_name +"/api/list-images/" + this.room_id)
            .then(response => {
            this.list_images = response.data;
            })
            .catch(error => {
            console.error(error);
            });
        },
        deleteImage(imageId, index) {
        axios
            .delete(this.host_name + "/api/delete-image/" + imageId)
            .then(res => {
                this.list_images.splice(index, 1);;
            })
            .catch(err => {
            console.error(err);
            });
        },
        asset(fileName) {
        return this.host_name + "/" + fileName;
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
