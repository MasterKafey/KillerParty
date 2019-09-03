<?php
namespace AppBundle\Service\Util;

use Symfony\Component\HttpKernel\Config\FileLocator;
use Symfony\Component\Yaml\Yaml;

class YamlParser
{

    /**
     * @var FileLocator
     */
    private $fileLocator;

    public function __construct(FileLocator $fileLocator)
    {
        $this->fileLocator = $fileLocator;
    }

    public function getContent($path)
    {
        $file = $this->getRealPath($path);
        return Yaml::parseFile($file);
    }
    public function setContent($path, array $content)
    {
        $file = $this->getRealPath($path);
        file_put_contents($file, Yaml::dump($content));
    }
    private function getRealPath($path)
    {
        return $this->fileLocator->locate($path);
    }
}