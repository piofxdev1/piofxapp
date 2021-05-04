$(document).ready(function () {
    /* Modal for Code Snippet */
    // var codeSnippetModal = {
    //     title: "Code Snippet",
    //     body: {
    //         type: "panel",
    //         items: [
    //             {
    //                 type: "textarea",
    //                 name: "codeSnippet",
    //                 label: "Enter the Code Snippet",
    //             },
    //         ],
    //     },
    //     buttons: [
    //         {
    //             type: "cancel",
    //             name: "closeButton",
    //             text: "Cancel",
    //         },
    //         {
    //             type: "submit",
    //             name: "submitButton",
    //             text: "Add",
    //             primary: true,
    //         },
    //     ],
    //     onSubmit: function (api) {
    //         var data = api.getData();
    //         tinymce.activeEditor.execCommand(
    //             "mceInsertContent",
    //             false,
    //             "<div class='code_snippet'>" +
    //                 Object.values(data) +
    //                 "<button type='button' class='btn btn-dark'>Edit</button></div>"
    //         );
    //         api.close();
    //     },
    // };
    // function upload_image(blobInfo, success, failure, progress) {
    //     var xhr, formData;
    //     xhr = new XMLHttpRequest();
    //     xhr.withCredentials = false;
    //     xhr.open("POST", "/admin/dropzone");
    //     xhr.upload.onprogress = function (e) {
    //         progress((e.loaded / e.total) * 100);
    //     };
    //     xhr.onload = function () {
    //         var json;
    //         if (xhr.status === 403) {
    //             failure("HTTP Error: " + xhr.status, { remove: true });
    //             return;
    //         }
    //         if (xhr.status < 200 || xhr.status >= 300) {
    //             failure("HTTP Error: " + xhr.status);
    //             return;
    //         }
    //         json = JSON.parse(xhr.responseText);
    //         if (!json || typeof json.location != "string") {
    //             failure("Invalid JSON: " + xhr.responseText);
    //             return;
    //         }
    //         success(json.location);
    //     };
    //     xhr.onerror = function () {
    //         failure(
    //             "Image upload failed due to a XHR Transport error. Code: " +
    //                 xhr.status
    //         );
    //     };
    //     formData = new FormData();
    //     formData.append("file", blobInfo.blob(), blobInfo.filename());
    //     xhr.send(formData);
    // }
    // document.domain = "piofx.test";
    // // TinyMCE -  Init
    // tinymce.init({
    //     selector: "#post_editor",
    //     min_height: 1000,
    //     relative_urls: false,
    //     paste_data_images: true,
    //     image_title: true,
    //     automatic_uploads: true,
    //     images_upload_url: "/admin/dropzone",
    //     file_picker_types: "image",
    //     image_upload_handler: upload_image,
    //     plugins: [
    //         "advlist autolink autoresize link image lists charmap print preview hr anchor pagebreak",
    //         "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
    //         "table emoticons template paste help",
    //     ],
    //     toolbar:
    //         "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | " +
    //         "bullist numlist outdent indent | link image code_snippet | print preview media fullpage | " +
    //         "forecolor backcolor emoticons | help",
    //     menu: {
    //         favs: {
    //             title: "My Favorites",
    //             items: "code visualaid | searchreplace | emoticons",
    //         },
    //     },
    //     menubar: "favs file edit view insert format tools table help",
    //     statusbar: false,
    //     setup: function (editor) {
    //         /* Basic button that just inserts code snippets */
    //         editor.ui.registry.addButton("code_snippet", {
    //             text: "Code Snippet",
    //             tooltip: "Insert Code Snippet",
    //             onAction: function (_) {
    //                 editor.windowManager.open(codeSnippetModal);
    //             },
    //         });
    //     },
    //     // images_upload_handler: upload_image,
    //     // override default upload handler to simulate successful upload
    // });
});

// Delete Image
function deleteImage() {
    // document.getElementById("featured_image").style.display = "none";
    $("#featured_image").removeClass("d-block");
    // $("#featured_image").addClass("d-none");
    $("#dropzone").removeClass("d-none");
    // $("#dropzone").addClass("d-block");
}

// Quill Js
var post_editor = document.getElementById("post_editor");
// var toolbarOptions = [
//     [{ header: [1, 2, 3, 4, 5, 6, false] }],
//     [{ font: [] }],
//     ["bold", "italic", "underline", "strike"], // toggled buttons
//     [{ color: [] }, { background: [] }], // dropdown with defaults from theme
//     [{ align: [] }],
//     [{ list: "ordered" }, { list: "bullet" }],
//     [{ script: "sub" }, { script: "super" }], // superscript/subscript
//     [{ indent: "-1" }, { indent: "+1" }], // outdent/indent
//     ["blockquote", "code-block"],
//     ["clean"], // remove formatting button
//     ["image"],
// ];
var quill = new Quill(post_editor, {
    theme: "snow",
    modules: {
        syntax: true, // Include syntax module
        toolbar: "#toolbar",
        table: true,
    },
});

function addHtmlContent(flag) {
    if (flag == "new") {
        require(["vs/editor/editor.main"], () => {
            monaco.editor.getModels().forEach((model) => model.dispose());

            // Initialize the editor
            if (document.getElementById("post_content")) {
                const post_content_editor = monaco.editor.create(
                    document.getElementById("post_content"),
                    {
                        theme: "vs-dark",
                        language: "html",
                        model: monaco.editor.createModel(
                            quill.container.firstChild.innerHTML,
                            "html"
                        ),
                        wordWrap: "on",
                        minimap: {
                            enabled: false,
                        },
                        scrollbar: {
                            vertical: "auto",
                        },
                        automaticLayout: 1,
                    }
                );

                console.log("here");

                // post_content_editor.onDidChangeModelContent(function (e) {
                //     document.getElementById(
                //         "post_content_editor"
                //     ).value = post_content_editor.getModel().getValue();
                // });
            }

            var myModal = new bootstrap.Modal(
                document.getElementById("html_modal"),
                {
                    keyboard: false,
                    backdrop: "static",
                }
            );
            myModal.show();
        });
    } else {
        let content = monaco.editor.getModels()[0].getValue();
        quill.container.firstChild.innerHTML = content;
        $("#html_modal").modal("hide");
    }
}

function addTextarea() {
    document.getElementById("post_textarea").innerHTML =
        quill.container.firstChild.innerHTML;
    document.getElementById("post_form").submit();
}

function showGroup() {
    var private = document.getElementById("private");
    var group = document.getElementById("group");
    group.style.display = private.checked ? "block" : "none";
}
