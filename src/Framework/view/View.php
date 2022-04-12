<?php

namespace Framework\view;

//componsite parrtan

use Framework\view\exceptions\ViewFileNotFoundException;
use Framework\view\interfaces\RenderableInterface;
use function Composer\Autoload\includeFile;

class View
{
    public $base = '';


    public function __construct()
    {
        $this->base = realpath($_SERVER['DOCUMENT_ROOT']) . '/../app/Views/';
    }

    public function resolve(string $path, array $data = []): ?string
    {
        $fullFilePath = $this->base . $path . '.render.php';
        if (file_exists($fullFilePath)) {
            ob_start();
            $file = file_get_contents($fullFilePath);
            extract($data);

            var_dump(eval("?>$file"));exit;
            $outputBuffer = ob_get_clean();
            return $outputBuffer;
        }
        throw new ViewFileNotFoundException();
    }

    public function render(string $path)
    {
//        //Find themplate file
//        $dom = new \DOMDocument();
//        $dom->loadHTMLFile($this->base.$path.'.render.php');
//
//        $links = $dom->getElementsByTagName('render-div');
//        var_dump($links->item(0));exit;
    }
}