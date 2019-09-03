<?php

namespace AppBundle\Service\Business;

use AppBundle\Service\Util\RequestParamConverter;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Translation\TranslatorInterface;

/**
 * Class Breadcrumb
 * @package DigitalRespawn\BreadcrumbBundle\Breadcrumb
 * @author  Vincent MARIUS <vincent.marius@digitalrespawn.com>
 */
class BreadcrumbBusiness
{
    /**
     * @var RouterInterface
     */
    protected $router;

    /**
     * @var TranslatorInterface
     */
    protected $translator;

    /**
     * @var RequestStack
     */
    protected $requestStack;

    /**
     * @var RequestParamConverter
     */
    protected $requestParamConverter;

    /**
     * Breadcrumb constructor.
     *
     * @param RouterInterface $router : Router Service
     * @param TranslatorInterface $translator : Translation Service
     * @param RequestStack $requestStack : Request Stack
     * @param RequestParamConverter $requestParamConverter : Param Converter
     */
    public function __construct(
        RouterInterface $router,
        TranslatorInterface $translator,
        RequestStack $requestStack,
        RequestParamConverter $requestParamConverter
    )
    {
        $this->router = $router;
        $this->translator = $translator;
        $this->requestStack = $requestStack;
        $this->requestParamConverter = $requestParamConverter;
    }

    /**
     * Generate the breadcrumb as an array
     *
     * @return array $breadcrumb : Array of item composing the breadcrumb
     *
     * @throws \Exception : Malformed routes
     */
    public function getBreadcrumb()
    {
        $breadcrumb = array();
        $routes = $this->router->getRouteCollection();
        $masterRequest = $this->requestStack->getMasterRequest();
        $locale = $masterRequest->getLocale();
        try {
            $uri = $this->router->generate(
                $masterRequest->attributes->get('_route'),
                $masterRequest->attributes->get('_route_params')
            );
            $route = $routes->get($masterRequest->get('_route'));
            $params = $masterRequest->attributes->get('_route_params');
            $request = $this->requestParamConverter->getConvertedRequestFromRoute($route, $params);
            while (null !== $route) {
                try {
                    $breadcrumbOptions = $route->getOption('breadcrumb');
                    if (null === $breadcrumbOptions) {
                        break;
                    }
                    if (!isset($breadcrumbOptions['label'])) {        // Don't display if no label
                        continue;
                    }

                    $label = $breadcrumbOptions['label'];
                    // Adding the item to the breadcrumb

                    $item = array(
                        'uri' => $uri,
                        'label' => $label,
                    );

                    if (isset($breadcrumbOptions['icon'])) {
                        $item['icon'] = $breadcrumbOptions['icon'];
                    }

                    $breadcrumb[] = $item;

                    $route = null;
                    if (!isset($breadcrumbOptions['parent'])) {    // Stops if no parent
                        break;
                    }
                    if (isset($breadcrumbOptions['parent_params'])) {    // Binding parent's params if set
                        $params = $this->bindValues($request, $breadcrumbOptions['parent_params']);
                    } else {
                        $params = array();
                    }
                    $route = $routes->get($breadcrumbOptions['parent']);    // Getting parent route
                    $request = $this->requestParamConverter->getConvertedRequestFromRoute(
                        $route,
                        $params
                    );    // Bind params in request
                    $uri = $this->router->generate($breadcrumbOptions['parent'], $params);    // Generating parent's URI
                } catch (\Exception $e) {
                    if (!$this->config['enable_errors']) {    // If errors are disable -> stop breadcrumb
                        $route = null;
                    } else {
                        throw new \Exception('Breadcrumb Error : Check your routes\' syntax');
                    }
                }
            }
        } catch (\Exception $e) {
            if (!$this->config['enable_errors']) {    // If errors are disable -> stop breadcrumb
                return array();
            } else {
                throw $e;
            }
        }
        return array_reverse($breadcrumb);
    }

    /**
     * Bind values from request to an array of params
     *
     * @param Request $request : The request with converted params
     * @param array $binding : Associative array of elements to bind
     * @param string $delimiter : Delimiter used to match param's name
     *
     * @return array $params : Bound values
     */
    public function bindValues(Request $request, array $binding, $delimiter = '')
    {
        $params = array();
        if (count($binding) > 0) {
            foreach ($binding as $key => $value) {
                $binding = explode('.', $value);
                $object = $request->get($binding[0]);
                for ($i = 1; $i < count($binding); ++$i) {
                    if (is_array($object)) {
                        $object = $object[$i];
                    } else {
                        $getter = 'get' . ucfirst($binding[$i]);
                        $object = $object->$getter();
                    }
                }
                $params[$delimiter . $key . $delimiter] = $object;
            }
        }
        return $params;
    }
}
