<?php

namespace App\Core;

use Exception;

/**
 * @package View
 */
class View
{
    protected Exceptions $exception;

    public function __construct()
	{
		//todo
	}
    
    /**
	 * @param string $view
	 * @param array $params
     * @param string $layout
	 */
    public static function render($view, $params = [], $layout = "")
    {
        $view_to_render = "";
        foreach($params as $key => $value){
            $$key = $value;
        }
        if(isset($layout) && !empty($layout)) {
            try {
                $viewContent = self::renderWithoutLayout($view, $params = []);
                ob_start();
                require_once dirname(__DIR__) . "/resource/views/layout/$layout.php";
                $layoutContent = ob_get_clean();
                $view_to_render = str_replace("{{content}}", $viewContent, $layoutContent);
            } catch(Exception $e) {
                $exception = new Exceptions;
                $exception->log($e->getMessage());
            }
        } else {
            ob_start();
            require_once getcwd() . "/resource/views/$view.php";
            $view_to_render = ob_get_clean();
        }
        echo $view_to_render;
        return;
    }

    /**
	 * @param string $view
	 * @param array $params
	 */
    public static function renderWithoutLayout($view, $params = [])
    {
        ob_start();
        require_once getcwd() . "/resource/views/$view.php";
        return ob_get_clean();
    }

}