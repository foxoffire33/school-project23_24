<?php

namespace Framework\view;

//componsite parrtan

use Framework\router\exceptions\ViewFileNotFoundException;
use Framework\view\interfaces\RenderableInterface;
use function Composer\Autoload\includeFile;

class View
{
    public $base = '';


    public function __construct()
    {
        $this->base = realpath($_SERVER['DOCUMENT_ROOT']) . '/../app/Views/';
    }

    public function resolve(string $path, array $data = []): Void {
        $fullFilePath = $this->base.$path.'.render.php';
        if(file_exists($fullFilePath)){
            extract($data);
            include $fullFilePath;
        }else {
            throw new ViewFileNotFoundException();
        }
    }

    public function render(){
        //Find themplate file

    }
}