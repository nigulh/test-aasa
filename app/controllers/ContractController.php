<?php
require_once __DIR__  . "/../models/Contract.php";
require_once __DIR__  . "/../validation/Validator.php";
require_once __DIR__  . "/../validation/Constraints/Range.php";

use \Psr\Container\ContainerInterface as ContainerInterface;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;


class ContractController
{
    protected $container;
    protected $viewTemplateName;

    // constructor receives container instance
    public function __construct(ContainerInterface $container) {
        $this->container = $container;
        $this->viewTemplateName = 'contract.html';
    }

    public function init(Request $request, Response $response, $args) {
        $content = $this->getContent($request);
        $response->getBody()->write($this->render($content));

        return $response;
    }

    public function create(Request $request, Response $response, $args) {
        $content = $this->getContent($request);
        $response->getBody()->write($this->render($content));

        return $response;
    }

    protected function viewTemplate() {
        return $this->container->twig->load($this->viewTemplateName);
    }

    protected function render($content) {
        return $this->viewTemplate()->render($content);
    }

    protected function getFields() {
        return array("name" => "Name", "identityCode" => "ID Code");
    }

    protected function getData($requestData) {
        $contract = new Contract();
        $contract->name = "foo";
        $contract->identityCode = 123;
        if (is_array($requestData)) {
            foreach ($requestData as $key => $value) {
                $contract->$key = $value;
            }
        }

        return $contract;
    }

    /**
     * @return Validator
     */
    protected function getValidator()
    {
        $validator = new Validator();
        $validator->addFieldConstraint("identityCode", new Range(1, 1000));
        return $validator;
    }

    /**
     * @param Request $request
     * @param Boolean $useValidation
     * @return array
     */
    protected function getContent(Request $request)
    {
        $content = array();
        $content["fields"] = $this->getFields();
        $data = $this->getData($request->getParsedBody());
        $content["data"] = $data;
        $useValidation =  $request->getMethod() == "POST";
        if ($useValidation) {
            $content["messages"] = $messages = $this->getValidator()->validate($data);
            $content["fail"] = count($messages) > 0;
        }
        return $content;
    }
}

