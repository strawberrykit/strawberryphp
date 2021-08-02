<?php

declare(strict_types=1);

namespace strawberrykit\strawberryphp\app;

class ResponseSchema
{
    private $statusCode;
    private $exception;

    public function __construct() {
    }

    public function code(int $code)
    {
        $this->statusCode = $code;
        return $this;
    }

    public function exception(string $exception)
    {
        $this->exception = $exception;
        return $this;
    }

    public function json(array $json = null)
    {
        header('Content-Type: application/json');
        $json["error"] = $this->exception;
        echo json_encode($json);
        return $this;
    }

    public function send()
    {
        http_response_code($this->statusCode);
    }


}
