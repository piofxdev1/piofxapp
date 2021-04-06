$(document).ready(function () {
    if(document.getElementById("delete_image"))
    document.getElementById("delete_image").onclick = function () {
        document.getElementById("featured_image").style.display = "none";
        document.getElementById("dropzone").style.display = "block";
    };

    if(document.getElementById("image_url"))
    let image_url = document.getElementById("image_url").value;

    //console.log(image_url);

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

    // TinyMCE -  Init
    tinymce.init({
        selector: "#post_editor",
        min_height: 500,
        relative_urls: false,
        paste_data_images: true,
        image_title: true,
        automatic_uploads: true,
        images_upload_url: "/blog/upload/image",
        file_picker_types: "image",
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
        file_picker_callback: function (cb, value, meta) {
            var input = document.createElement("input");
            input.setAttribute("type", "file");
            input.setAttribute("accept", "image/*");
            input.onchange = function () {
                var file = this.files[0];
                console.log(this.files);

                var reader = new FileReader();
                reader.readAsDataURL(file);
                reader.onload = function () {
                    var id = "blobid" + new Date().getTime();
                    var blobCache = tinymce.activeEditor.editorUpload.blobCache;
                    var base64 = reader.result.split(",")[1];
                    var blobInfo = blobCache.create(id, file, base64);
                    blobCache.add(blobInfo);
                    cb(blobInfo.blobUri(), { title: file.name });
                };
            };
            console.log(input);
            input.click();
        },
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
