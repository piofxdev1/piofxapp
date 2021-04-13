

<!--end::Global Config-->
<!--begin::Global Theme Bundle(used by all pages)-->
<script src="{{ asset('themes/metronic/plugins/global/plugins.bundle.js?v=7.0.5')}}"></script>
<script src="{{ asset('themes/metronic/plugins/custom/prismjs/prismjs.bundle.js?v=7.0.5')}}"></script>
<script src="{{ asset('themes/metronic/js/scripts.bundle.js?v=7.0.5')}}"></script>
<!--end::Global Theme Bundle-->
<!--begin::Page Vendors(used by this page)-->
<script src="{{ asset('themes/metronic/plugins/custom/fullcalendar/fullcalendar.bundle.js?v=7.0.5') }}"></script>
<script src="{{ asset('themes/metronic/plugins/custom/gmaps/gmaps.js?v=7.0.5')}}"></script>
<!--end::Page Vendors-->
<!--begin::Page Scripts(used by this page)-->
<script src="{{ asset('themes/metronic/js/pages/widgets.js?v=7.0.5')}}"></script>
<!-- begin::highlight js-->
<script src="{{  asset('js/highlight/highlight.pack.js') }}"></script>
<script>hljs.initHighlightingOnLoad();</script>
<!-- end::highlight js-->

<!--begin::Page Scripts(used by this page)-->
<script src="{{ asset('themes/metronic/js/pages/crud/file-upload/dropzonejs.js?v=7.2.3') }}"></script>
<script src="{{ asset('themes/metronic/js/pages/crud/forms/widgets/select2.js?v=7.0.5') }}"></script>
<script src="{{ asset('themes/metronic/js/pages/crud/forms/widgets/bootstrap-datetimepicker.js?v=7.0.5') }}"></script>
<!--end::Page Scripts-->

<script src="{{ asset('themes/metronic/js/pages/features/charts/apexcharts.js?v=7.0.5') }}"></script>
<script src="{{ asset('js/loyalty/loyalty.js') }}"></script>

<script src="{{  asset('js/codemirror/lib/codemirror.js') }}"></script>
<script src="{{  asset('js/codemirror/mode/javascript/javascript.js') }}"></script>
<script src="{{asset('js/codemirror/mode/xml/xml.js')}}"></script>  
<script src="{{asset('js/codemirror/mode/javascript/javascript.js')}}"></script> 
<script src="{{asset('js/codemirror/mode/clike/clike.js')}}"></script>  
<script src="{{asset('js/codemirror/addon/display/autorefresh.js')}}"></script>  
<script src="{{asset('js/codemirror/mode/markdown/markdown.js')}}"></script>  
<script>
	var options = {
          lineNumbers: true,
          lineWrapping:true,
          styleActiveLine: true,
          matchBrackets: true,
          autoRefresh:true,
          mode: "text/x-c++src",
          theme: "eclipse",
          indentUnit: 4
        };
    if(document.getElementById("editor")){
    var editor = CodeMirror.fromTextArea(document.getElementById("editor"), options);
    editor.setSize(null, 900);
     var editor2 = CodeMirror.fromTextArea(document.getElementById("editor2"), options);
   }

   $(function () {
      $('[data-toggle="tooltip"]').tooltip()
    })
   
</script>
<!--end::Page Scripts-->

<!-- contact form -->
<script>
     $(function () {
      $( "#contact_form" ).submit(function( event ) {
          alert( "Handler for .submit() called." );
          event.preventDefault();
        });
    });
</script>

<!--- end of contact form -->
<!-- Monaco editor -->
<script>
    var require = {
        paths: {
            'vs': '{{ asset("/monaco-editor/min/vs")}}',
        }
    };
</script>
<script src="{{ asset('monaco-editor/min/vs/loader.js') }}"></script>
<script>
    require(['vs/editor/editor.main'], () => {
        // Initialize the editor
        if(document.getElementById("content")){
            const editor = monaco.editor.create(document.getElementById("content"), {
               theme: 'vs-dark',
               model: monaco.editor.createModel(document.getElementById("content_editor").value, "markdown"),
               wordWrap: 'on',
               minimap: {
                   enabled: true
               },
               scrollbar: {
                   vertical: 'auto'
               }
           });

           editor.onDidChangeModelContent(function (e) {
               document.getElementById('content_editor').value = editor.getModel().getValue();
            });

        }
        
        if(document.getElementById("content2")){
            const editor2 = monaco.editor.create(document.getElementById("content2"), {
            theme: 'vs-dark',
            model: monaco.editor.createModel(document.getElementById("content_editor2").value, "markdown"),
            wordWrap: 'on',
            minimap: {
                enabled: false
            },
            scrollbar: {
                vertical: 'auto'
            }
        });

        editor2.onDidChangeModelContent(function (e) {
            document.getElementById('content_editor2').value = editor2.getModel().getValue();
         });
        }
        

    });
</script>

<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<!-- Custom Js -->
<script src="{{ asset('js/Blog/blog.js') }}"></script> 
