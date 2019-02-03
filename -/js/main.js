// head {
var __nodeId__ = "std_ui_mce__main";
var __nodeNs__ = "std_ui_mce";
// }

(function (__nodeNs__, __nodeId__) {
    $.widget(__nodeNs__ + "." + __nodeId__, {
        options: {},

        _create: function () {
            this.bind();
        },

        _destroy: function () {

        },

        _setOption: function (key, value) {
            $.Widget.prototype._setOption.apply(this, arguments);
        },

        bind: function () {
            var widget = this;

            var editorOptions = {
                setup: function (editor) {
                    editor.on('change', function (e) {
                        //tinymce.triggerSave();
                        //console.log('change event', e);
                    });
                },

                save_onsavecallback: function (editor) {
                    var requestData = {};

                    $.extend(requestData, widget.options.requestData);
                    $.extend(requestData, {
                        value: editor.getContent()
                    });

                    request(widget.options.requestPath, requestData);

                    editor.hide();
                }
            };

            $.extend(editorOptions, widget.options.editorOptions);

            tinymce.baseURL = widget.options.baseURL;
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
