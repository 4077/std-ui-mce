<?php namespace std\ui\mce\controllers;

class Install extends \Controller
{
    public function run()
    {
        $dir = $this->_module()->dir;

        $copyList = [
            '/-/install/filemanager'        => '-/mce/filemanager',
            '/-/install/filemanager_thumbs' => '-/mce/filemanager_thumbs',
            '/-/install/js'                 => '-/mce/js'
        ];

        foreach ($copyList as $source => $target) {
            copy_dir(abs_path($dir, $source), public_path($target));
        }
    }
}
