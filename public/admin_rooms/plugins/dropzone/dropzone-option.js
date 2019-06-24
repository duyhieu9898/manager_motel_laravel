Dropzone.autoDiscover = false;

$(document).ready(function() {
    const URL_PATH_UPLOAD = $('#js_url_path_upload').val();
    const URL_PATH_DELETE = $('#js_url_path_delete').val();
    var photo_counter = 0;

    var myDropzone = new Dropzone("#id_dropzone", {
        url: URL_PATH_UPLOAD,
        method: 'PUT',
        headers: {
            'X-CSRF-TOKEN': $('meta[name = "csrf-token"]').attr('content')
        },
        autoProcessQueue: true,
        uploadMultiple: true,
        parallelUploads: 100,
        maxFiles: 10,
        maxFilesize: 5,
        addRemoveLinks: true,
        acceptedFiles: ".jpeg,.jpg,.png,.gif",
        dictRemoveFile: 'Remove',
        dictFileTooBig: 'Image is bigger than 3MB',
        // The setting up of the dropzone

        init: function() {

            this.on("removedfile", function(file) {
                console.log(file);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });
                $.ajax({
                    type: 'DELETE',
                    url: URL_PATH_DELETE,
                    data: { id: file.name },
                    dataType: 'html',
                    success: function(data) {
                        var rep = JSON.parse(data);
                        if (rep.code == 200) {
                            photo_counter--;
                            $("#photoCounter").text("(" + photo_counter + ")");
                        }

                    }
                });

            });
        },
        error: function(file, response) {
            if ($.type(response) === "string")
                var message = response; //dropzone sends it's own error messages in string
            else
                var message = response.message;

            file.previewElement.classList.add("dz-error");
            _ref = file.previewElement.querySelectorAll("[data-dz-errormessage]");
            _results = [];
            for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                node = _ref[_i];
                _results.push(node.textContent = message);
            }
            console.log(_results);
            return _results;
        },
        success: function(file, res) {
            console.log(res);
            photo_counter++;
            $("#photoCounter").text("(" + photo_counter + ")");
        }
    });
    console.log(myDropzone);
})