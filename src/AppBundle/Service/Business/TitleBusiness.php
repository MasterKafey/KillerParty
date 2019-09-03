<?php

namespace AppBundle\Service\Business;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Routing\RouterInterface;

class TitleBusiness
{
    /**
     * @var RouterInterface
     *
     */
    private $router;

    /**
     * @var Request
     */
    private $request;

    /**
     * @param RequestStack $requestStack
     * @param RouterInterface $router
     */
    public function __construct(RequestStack $requestStack, RouterInterface $router)
    {
        $this->router = $router;
        $this->request = $requestStack->getMasterRequest();
    }

    public function getTitles()
    {
        $currentRoute = $this->request->attributes->get('_route');
        $route = $this->router->getRouteCollection()->get($currentRoute);
        $titles = $route->getOption('titles');

        return $titles;
    }
}
