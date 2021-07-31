<?php

declare(strict_types=1);

namespace strawberrykit\strawberryphp\config;

class Resource
{
    private $path = '/public';

    public function setResourcePath(string $path)
    {
        if (!$path==="/") $this->path = $path;
    }

    public function getResourcePath()
    {
        return $this->path;
    }

    public function mapResource()
    {
        $this->path = $_SERVER["DOCUMENT_ROOT"].$this->path."/";
        return $this;
    }

}
