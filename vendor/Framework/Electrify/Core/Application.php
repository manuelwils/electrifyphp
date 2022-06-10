<?php

namespace Electrify\Core;

use Electrify\Core\Hash;
use Electrify\Core\View;
use Electrify\Core\Cookie;
use Electrify\Core\Router;
use Electrify\Core\Writer;
use Electrify\Core\Process;
use Electrify\Core\Request;
use Electrify\Core\Session;
use Electrify\Core\Response;
use Electrify\Core\Validator;
use Electrify\Core\Controller;
use Electrify\Core\Exceptions;
use Electrify\Core\Eloquent\Model;
use Electrify\Core\Eloquent\Authentication;

/**
 * Electrify Application
 * @package Application
 */
class Application
{

    /**
     * packages in core
     */
    public Controller $controller;
    public Cookie $cookie;
    public Exceptions $exception;
    public Hash $hash;
    public Process $process;
    public Request $request;
    public Response $response;
    public Router $router;
    public Session $session;
    public Validator $validator;
    public View $view;
    public Writer $writer;

    public static Application $app;

    /**
     * packages in core/eloquent
     */
    protected Model $model;
    private string $modelTable = "";
    private array $modelFillable = [];

    protected Authentication $auth;

    /**
     * Initialize Application
     */
    public function __construct($modelArguments = null)
    {

        if(isset($modelArguments) && is_array($modelArguments)) {
            $this->modelTable = $modelArguments[0];
            $this->modelFillable = $modelArguments[1];
        }

        $this->controller = new Controller;
        $this->cookie = new Cookie;
        $this->exception = new Exceptions;
        $this->hash = new Hash;
        $this->process = new Process;
        $this->request = new Request;
        $this->response = new Response;
        $this->router = new Router;
        $this->session = new Session;
        $this->validator = new Validator;
        $this->view = new View;
        $this->writer = new Writer;
        $this->model = new Model($this->modelTable, $this->modelFillable);
        $this->auth = new Authentication;
        self::$app = $this;
    }

    /**
     * @param $dir
     * @return string
     */
    public static function appRoot($dir = null)
    {
        if(!isset($dir)) return getcwd();
        return $dir;
    }

    /**
     * create an instance of Application
     */
    public static function instance()
    {
        return new Application();
    }

    /**
     * create an instance of other packages
     * @param mixed $params
     * @package $package
     */
    public static function instantiate($package, ...$params)
    {
        $class = new $package(...$params);
        return $class;
    }
}
