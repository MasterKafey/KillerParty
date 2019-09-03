<?php

namespace AppBundle\Service\Business;


use AppBundle\Service\Util\YamlParser;

class NavBarBusiness
{
    const NAV_BAR_CONFIGURATION_FOLDER = '@AppBundle/Resources/config/nav_bar/';
    const FILE_EXTENSION = 'yml';

    /**
     * @var YamlParser
     */
    private $parser;

    public function __construct(YamlParser $parser)
    {
        $this->parser = $parser;
    }

    public function getNavBar($name)
    {
        return $this->parser->getContent(self::NAV_BAR_CONFIGURATION_FOLDER . $name . '.' . self::FILE_EXTENSION);
    }
}
