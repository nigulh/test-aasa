<?php
use \Psr\Container\ContainerInterface as ContainerInterface;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;


class AboutController
{
    protected $container;

    // constructor receives container instance
    public function __construct(ContainerInterface $container) {
        $this->container = $container;
    }

    public function about(Request $request, Response $response, $args)
    {
        $fields = array("time" => date("H:i:s"));
        $responseData = $this->container->get('twig')->load('about.html')->render($fields);
        $response->getBody()->write($responseData);
        return $response;
    }
}
