// head {
var __nodeId__ = "std_ui_mce__main";
var __nodeNs__ = "std_ui_mce";
// }

(function (__nodeNs__, __nodeId__) {
    $.widget(__nodeNs__ + "." + __nodeId__, $.ewma.node, {
        options: {},

        __create: function () {
            var w = this;

            w.bind();
        },

        bind: function () {
            var w = this;
            var o = w.options;
            var $w = w.element;

            var editorOptions = {
                setup: function (editor) {
                    editor.on('change', function (e) {
                        //tinymce.triggerSave();
                        //console.log('change event', e);
                    });

                    editor.on('keydown keyup', function (e) {
                        e.stopPropagation();
                        //tinymce.triggerSave();
                        //console.log('change event', e);
                    });
                },

                save_onsavecallback: function (editor) {
                    var requestData = {};

                    $.extend(requestData, o.requestData);
                    $.extend(requestData, {
                        value: editor.getContent()
                    });

                    request(w.options.requestPath, requestData);

                    editor.hide();
                }
            };

            $.extend(editorOptions, o.editorOptions);

            tinymce.baseURL = o.baseURL;
            tinymce.suffix = ".min";

            tinymce.init(editorOptions);

            //var editTriggerElement = widget.element;
            //
            //if (widget.options.editTriggerClosestSelector) {
            //    editTriggerElement = widget.element.closest(widget.options.editTriggerClosestSelector);
            //}
            //
            //editTriggerElement.rebind("click", function () {
            //    widget.element.tinymce(editorOptions);
            //});

            // появляются с задержкой
            //widget.element.tinymce(editorOptions);
        }
    });
})(__nodeNs__, __nodeId__);
