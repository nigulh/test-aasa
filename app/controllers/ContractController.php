<?php namespace App\Controllers;

use App\Models\ContractValidator;
use \Psr\Container\ContainerInterface as ContainerInterface;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use App\Models\Contract as Contract;
use App\Validation\Validator;

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
        return array(
            "name" => "Name",
            "identityCode" => "ID Code",
            "amountInCurrency" => "Amount",
            "durationInMonths" => "Number of months",
            "purposeOfUse" => "Purpose"
        );
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
        return new ContractValidator();
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
            $success = count($messages) == 0;
            if ($success) {
                $success = $this->save($data);
                $content["dataPath"] = $this->getDataPath($data);
            }
            $content["success"] = $success;
        }
        return $content;
    }


    protected function save($data)
    {
        $dataPath = $this->getDataPath($data);
        $file = fopen($dataPath, "w");
        if (!$file) {
            return false;
        }
        fwrite($file, json_encode($data));
        fclose($file);
        return true;
    }

    /**
     * @param $data
     * @return string
     */
    protected function getDataPath($data)
    {
        $id = spl_object_hash($data);
        $path = dirname(dirname(__DIR__)) . "/data/contracts";
        if (!file_exists($path)) {
            if (!mkdir($path, 0755, true)) {
                return false;
            }
        }
        $dataPath = $path . "/" . $id . ".txt";
        return $dataPath;
    }
}

