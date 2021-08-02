<?php

declare(strict_types=1);

namespace strawberrykit\strawberryphp\app;

class RequestFactory
{
    /**
     * @var object $query
     * Stores the query parameters as object
     */
    private $query;

    /**
     * @var object $payload
     * Stores the payload paramaters as object
     */
    private $payload;

    /**
     * @var object $files
     * Stores the file properties as object
     */
    private $files;

    /**
     * @var object $resource
     * Stores the resource requested as object
     */
    private $resource;

    public function __construct()
    {
        $this->query     = new Class {};
        $this->payload   = new Class {};
        $this->files     = new Class {};
        $this->resource  = new Class {};
    }

    /**
     * @param void
     * @return object $query
     */
    public function query()
    {
        return $this->query;
    }

    /**
     * @param void
     * @return object $payload
     */
    public function payload()
    {
        return $this->payload;
    }

    /**
     * @param void
     * @return object $files
     */
    public function files()
    {
        return $this->files;
    }

    /**
     * @param void
     * @return object $resource
     */
    public function resource()
    {
        return $this->resource;
    }

}
