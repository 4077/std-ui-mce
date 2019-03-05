<?php namespace std\ui\mce\controllers;

class Main extends \Controller
{
    public function view()
    {
        $this->_instance(true);

        $v = $this->v('|');

        $v->assign([
                       'CLASS'   => $this->data('class'),
                       'CONTENT' => $this->data('content')
                   ]);

        $this->css();
        $this->js('tinymce.min');
        $this->js('jquery.tinymce.min');

        $widgetOptions = $this->getWidgetOptions();

        aa($widgetOptions, [
            'editorOptions' => $this->getEditorOptions()
        ]);

        $this->widget(':|', $widgetOptions);

        return $v;
    }

    private function getWidgetOptions()
    {
        $widgetOptions = [
            'requestPath' => false,
            'requestData' => [],
            'baseURL'     => abs_url('-/mce/js')
        ];

        if ($path = $this->data('path')) {
            $widgetOptions['requestPath'] = $this->_caller()->_p($path);
        }

        ra($widgetOptions['requestData'], $this->data('data'));

        remap($widgetOptions, $this->data, 'editTriggerClosestSelector');

        return $widgetOptions;
    }

    private function getEditorOptions()
    {
        $options = $this->getEditorDefaultOptions();

        ra($options, $this->getEditorPreset($this->data('preset')));

        ra($options, [
            'selector' => $this->_selector('|')
        ]);

        remap($options, $this->data, 'inline, height');

        ra($options, $this->data('options'));
        ra($options, $this->getEditorHardOptions());

        return $options;
    }

    private $presets = [
        'min'  => [
            'menubar'  => false,
            'plugins'  => [
                'save autosave code'
            ],
            'toolbar1' => 'save cancel | undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | code'
        ],
        'full' => [
            'menubar'      => true,
            'plugins'      => [
                'save autosave image advlist autolink lists link charmap print preview hr anchor pagebreak',
                'searchreplace wordcount visualblocks visualchars code fullscreen',
                'insertdatetime media nonbreaking table contextmenu directionality',
                'emoticons template paste textcolor colorpicker textpattern imagetools responsivefilemanager'
            ],
            'toolbar1'     => 'save cancel | insertfile undo redo | styleselect | fontsizeselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
            'toolbar2'     => 'print preview media | forecolor backcolor emoticons | responsivefilemanager',
            'image_advtab' => true
        ]
    ];

    private function getEditorPreset($preset)
    {
        return $this->presets[$preset] ?? $this->presets['min'];
    }

    private function getEditorHardOptions()
    {
        mdir($this->_public('filemanager'));

        return [
            'mode'                      => 'exact',
            'language'                  => 'ru',
            'document_base_url'         => abs_url('files') . '/',
            'external_filemanager_path' => abs_url('-/mce/filemanager') . '/',
            'filemanager_title'         => 'Files',
            'external_plugins'          => [
                'filemanager' => abs_url('-/mce/filemanager/plugin.min.js')
            ]
        ];
    }

    private function getEditorDefaultOptions()
    {
        return [
            'theme'         => 'modern',
            'relative_urls' => false,
            'suffix'        => '.min',
        ];
    }
}
