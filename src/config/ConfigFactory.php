<?php

declare(strict_types=1);

namespace strawberrykit\strawberryphp\config;
use strawberrykit\strawberryphp\config\Endpoint;
use strawberrykit\strawberryphp\config\Resource;

class ConfigFactory
{
    private $endpointObj;
    private $resourceObj;

    public function __construct()
    {
        $this->endpointObj = new Endpoint;
        $this->resourceObj = new Resource;
    }

    public function setEndpoint(string $endpointStructure = null)
    {
        if ($endpointStructure === null) {
            throw new \Exception(
                'Endpoint configuration cannot be empty'
            );
        }
        return $this->endpointObj->setEndpoint(
            structure: $endpointStructure
        );
    }

    public function setResourcePath(string $resourcePath = null)
    {
        if ($resourcePath === null) {
            throw new \Exception(
                'Resource path configuration cannot be empty'
            );
        }

    }

    public function mapResource()
    {
        return $this->resourceObj->mapResource();
    }

    public function mapEndpoint(array $uris)
    {
        return $this->endpointObj->mapEndpoint(
            uris: $uris
        );
    }
}
