Dropzone.autoDiscover = false;

$(document).ready(function() {
    const URL_PATH_UPLOAD = $("#js_url_path_upload").val();
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
});
