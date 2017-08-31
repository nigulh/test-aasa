<?php
use \Psr\Container\ContainerInterface as ContainerInterface;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;


class ContractController
{
    protected $container;

    // constructor receives container instance
    public function __construct(ContainerInterface $container) {
        $this->container = $container;
    }

    public function init(Request $request, Response $response, $args) {
        $fields = $this->createData();

        $responseData = $this->render('contract-init.html', array("fields" => $fields));
        $response->getBody()->write($responseData);

        return $response;
    }

    public function create(Request $request, Response $response, $args) {
        $fields = $this->createData();
        $params = $request->getParsedBody();

        foreach($fields as &$field) {
            $field["value"] = $params[$field["name"]];
        }

        $responseData = $this->render('contract-create-fail.html', array("fields" => $fields));
        $response->getBody()->write($responseData);

        return $response;
    }

    protected function render($name, $data) {
        return $this->container->get('twig')->load($name)->render($data);
    }

    protected function createData() {
        $createData = function($name, $title, $value, $message) {return array("name" => $name, "title" => $title, "value" => $value, "message" => $message);};

        return array($createData("name", "Name", "uus", "Please enter name"), $createData("id", "ID Code", "124", ""));
    }
}

