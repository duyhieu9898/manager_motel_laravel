<template>
    <div class="card-box photo-room txt-full-width is-dirty is-upgraded">
        <div class="card-header d-flex justify-content-between">
            <div class="card__header--photo">Room Photos</div>
            <div class="image__add">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#image--model__add">Add Images</button>
                <!-- Modal -->
                <div class="modal fade" id="image--model__add" tabindex="-1" role="dialog" aria-labelledby="modalLongTitle" aria-hidden="true">
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
                                <button type="button" class="btn btn-primary" data-dismiss="modal" @click="getListImages()">BACK</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body photo-view">
            <div class="row">
                <div class="col-sm-4 text-sm-center" v-for="(image, index) in list_images" v-bind:key="image.id">
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
            host_name: null,
            list_images_id:[],
        };
    },
    created() {
        this.host_name = window.location.origin;
        this.getListImages();

    },
    mounted() {
        if(this.room_id){
            var URL_PATH_UPLOAD = "/api/upload-image/" + this.room_id;
        } else {
            var URL_PATH_UPLOAD = "/api/store-image/";
        }
        var vm=this;
        console.log(URL_PATH_UPLOAD);
        var photo_counter = 0;
        // default method post
        var myDropzone = new Dropzone("#id_dropzone", {
            url: URL_PATH_UPLOAD,
            headers: {
                "X-CSRF-TOKEN": $('meta[name = "csrf-token"]').attr("content")
            },
            parallelUploads: 100,
            maxFiles: 6,
            maxFilesize: 5,
            acceptedFiles: ".jpeg,.jpg,.png,.gif",
            dictRemoveFile: "Remove",
            dictFileTooBig: "Image is bigger than 5MB",
            paramName: "file",
            // The setting up of the dropzone

            init: function() {},
            error: function(file, response) {
                if ($.type(response) === "string") {
                    //dropzone sends it's own error messages in string
                    var message = response;
                } else {
                    var message = response.message;
                }

                file.previewElement.classList.add("dz-error");
                var _ref = file.previewElement.querySelectorAll("[data-dz-errormessage]");
                var _results = [];

                for (let _i = 0, _len = _ref.length; _i < _len; _i++) {
                    var node = _ref[_i];
                    _results.push((node.textContent = message));
                }

                console.log(_results);
                return _results;
            },
            success: function(file, response) {
                console.log(file);
                var image = new Image();
                image.src = file.dataURL;
                $('.photo-view>.row').append(image);


                console.log(response.image_id);
                vm.list_images_id.push(response.image_id);
                vm.$emit('arr-images-id',vm.list_images_id);
            }
        });
        console.log(myDropzone);

    },
    methods: {
        getListImages() {
            axios
                .get(this.host_name + "/api/list-images/" + this.room_id)
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
.image--remove {
    color: #337ab7 !important;
}

.image--remove:hover {
    text-decoration: underline !important;
}

.card__header--photo .car-body {
    min-height: 150px;
}
.photo-room .card-body{
    min-height:150px
}
</style>
