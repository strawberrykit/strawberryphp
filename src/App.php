<?php

declare(strict_types=1);

namespace strawberrykit\strawberryphp;
use strawberrykit\strawberryphp\app\RequestFactory;
use strawberrykit\strawberryphp\app\BootEngine;
use strawberrykit\strawberryphp\config\ConfigFactory;

class App
{
    /**
     * @var Request $request
     */
    private $request;

    /**
     * Creates a new app instance
     */
    public function __construct()
    {
        $this->request = new RequestFactory;
        $this->config = new ConfigFactory;
    }

    /**
     * @param void
     * @return void
     * Boots the application
     */
    public function boot()
    {
        $boot = new BootEngine(
            request: $this->request,
            config: $this->config
        );
        $boot->request();
        $boot->resource();
        $boot->query();
        $boot->payload();
        $boot->files();
    }

    /**
     * @param void
     * @return void
     * Serves the request
     */
    public function serve()
    {
        try {

            if (!file_exists($this->request->resource()->path)) {
                throw new \Exception(
                    'Resource not found'
                );
            }

            $request = $this->request;
            require_once $this->request->resource()->path;

        } catch (\Exception $e) {
            echo 'Exception::Server Error'.$e->getMessage();
        }
    }






}
