<?php

declare(strict_types=1);

namespace strawberrykit\strawberryphp\app;
use \strawberrykit\strawberryphp\app\ParseEngine;

class BootEngine extends ParseEngine
{
    /**
     * @var object $request
     */
    private $request;
    private $config;

    public function __construct(
        \strawberrykit\strawberryphp\app\RequestFactory $request,
        \strawberrykit\strawberryphp\config\ConfigFactory $config
        )
    {
        $this->request = $request;
        $this->config = $config;
    }

    /**
     * @param void
     * @return void
     * Gets the request method from the global $_SERVER array
     */
    public function request()
    {
        $this->request->method = strtolower($_SERVER["REQUEST_METHOD"]);
    }

    /**
     * @param void
     * @return void
     * Parses the URI and sets the resource path
     */
    public function resource()
    {
        ParseEngine::Uri(
            config: $this->config,
            request: $this->request,
            uri: $_SERVER["REQUEST_URI"]
        );
    }

    /**
     * @param void
     * @return void
     * Parses the query parameters
     */
    public function query()
    {
        ParseEngine::parseQuery(
            request: $this->request,
            query: $_SERVER["QUERY_STRING"]
        );
    }

    /**
     * @param void
     * @return void
     * Parses the request payload
     */
    public function payload()
    {
        ParseEngine::parsePayload(
            request: $this->request,
            payload: file_get_contents('php://input')
        );
    }

    /**
     * @param void
     * @return void
     * Parses the files with the request
     */
    public function files()
    {
        ParseEngine::parseFiles(
            request: $this->request,
            files: $_FILES
        );
    }
}
