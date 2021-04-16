$(document).ready(function () {
    document.getElementById("delete_image").onclick = function () {
        document.getElementById("featured_image").style.display = "none";
        document.getElementById("dropzone").style.display = "block";
    };

    let image_url = document.getElementById("image_url").value;

    console.log(image_url);

    if (!(image_url.length == 0 || image_url == "")) {
        document.getElementById("featured_image").style.display = "block";
        document.getElementById("dropzone").style.display = "none";
    } else {
        document.getElementById("featured_image").style.display = "none";
        document.getElementById("dropzone").style.display = "block";
    }

    /* Modal for Code Snippet */
    var codeSnippetModal = {
        title: "Code Snippet",
        body: {
            type: "panel",
            items: [
                {
                    type: "textarea",
                    name: "codeSnippet",
                    label: "Enter the Code Snippet",
                },
            ],
        },
        buttons: [
            {
                type: "cancel",
                name: "closeButton",
                text: "Cancel",
            },
            {
                type: "submit",
                name: "submitButton",
                text: "Add",
                primary: true,
            },
        ],
        onSubmit: function (api) {
            var data = api.getData();

            tinymce.activeEditor.execCommand(
                "mceInsertContent",
                false,
                "<div class='code_snippet'>" +
                    Object.values(data) +
                    "<button type='button' class='btn btn-dark'>Edit</button></div>"
            );
            api.close();
        },
    };

    function upload_image(blobInfo, success, failure, progress) {
        var xhr, formData;

        xhr = new XMLHttpRequest();
        xhr.withCredentials = false;
        xhr.open("POST", "/admin/dropzone");

        xhr.upload.onprogress = function (e) {
            progress((e.loaded / e.total) * 100);
        };

        xhr.onload = function () {
            var json;

            if (xhr.status === 403) {
                failure("HTTP Error: " + xhr.status, { remove: true });
                return;
            }

            if (xhr.status < 200 || xhr.status >= 300) {
                failure("HTTP Error: " + xhr.status);
                return;
            }

            json = JSON.parse(xhr.responseText);

            if (!json || typeof json.location != "string") {
                failure("Invalid JSON: " + xhr.responseText);
                return;
            }

            success(json.location);
        };

        xhr.onerror = function () {
            failure(
                "Image upload failed due to a XHR Transport error. Code: " +
                    xhr.status
            );
        };

        formData = new FormData();
        formData.append("file", blobInfo.blob(), blobInfo.filename());

        xhr.send(formData);
    }

    // TinyMCE -  Init
    tinymce.init({
        selector: "#post_editor",
        content_css: "css/Blog/blog.css",
        min_height: 500,
        relative_urls: false,
        paste_data_images: true,
        image_title: true,
        automatic_uploads: true,
        images_upload_url: "/admin/dropzone",
        file_picker_types: "image",
        image_upload_handler: upload_image,
        plugins: [
            "advlist autolink link image lists charmap print preview hr anchor pagebreak",
            "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
            "table emoticons template paste help",
        ],
        toolbar:
            "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | " +
            "bullist numlist outdent indent | link image code_snippet | print preview media fullpage | " +
            "forecolor backcolor emoticons | help",
        menu: {
            favs: {
                title: "My Favorites",
                items: "code visualaid | searchreplace | emoticons",
            },
        },
        menubar: "favs file edit view insert format tools table help",
        statusbar: false,
        setup: function (editor) {
            /* Basic button that just inserts code snippets */
            editor.ui.registry.addButton("code_snippet", {
                text: "Code Snippet",
                tooltip: "Insert Code Snippet",
                onAction: function (_) {
                    editor.windowManager.open(codeSnippetModal);
                },
            });
        },
        // images_upload_handler: upload_image,
        // override default upload handler to simulate successful upload
    });
});

// Create Slug from text
function slugify(text) {
    return text
        .toString() // Cast to string
        .toLowerCase() // Convert the string to lowercase letters
        .normalize("NFD") // The normalize() method returns the Unicode Normalization Form of a given string.
        .trim() // Remove whitespace from both sides of a string
        .replace(/\s+/g, "-") // Replace spaces with -
        .replace(/[^\w\-]+/g, "") // Remove all non-word chars
        .replace(/\-\-+/g, "-"); // Replace multiple - with single -
}

// Create slug on keyup in title field
function createSlug() {
    title = document.getElementById("title").value;
    slug = slugify(title);
    document.getElementById("slug").value = slug;
}
