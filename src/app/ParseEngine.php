<?php

declare(strict_types=1);

namespace strawberrykit\strawberryphp\app;
use \strawberrykit\strawberryphp\config\ConfigFactory;
use \strawberrykit\strawberryphp\app\RequestFactory;
use \strawberrykit\strawberryphp\config\Endpoint;
use \strawberrykit\strawberryphp\config\Resource;

class ParseEngine
{
    protected static function Uri(
        ConfigFactory $config,
        RequestFactory $request,
        string $uri
        )
    {
        $uris = explode('/', $uri);
        $path = Self::buildResourcePath(
            request: $request,
            endpoints: $config->mapEndpoint($uris),
            resources: $config->mapResource()
        );
        $request->resource()->path = $path;
        return;
    }

    protected static function parseQuery(
        RequestFactory $request,
        string $query
        )
    {
        parse_str($query, $data);
        if (empty($data)) return;
        Self::map (
            data: $data,
            object: $request->query()
        );
    }

    protected static function parsePayload (
        RequestFactory $request,
        string $payload
        )
    {
        $data = json_decode(urldecode($payload), true);

        # Uses parse_str for url-encoded form data
        if (!is_array($data)) parse_str($payload, $data);

        Self::map (
            data: $data,
            object: $request->payload()
        );
        return;
    }

    protected static function parseFiles (
        RequestFactory $request,
        array $files
        )
    {
        Self::map(
            data: $files,
            object: $request->files()
        );
        return;
    }

    private static function buildResourcePath(
        RequestFactory $request,
        Endpoint $endpoints,
        Resource $resources
        )
    {
        # Adding forward slash if gateway is provided
        $gateway = isset($endpoints->gateway)
                   ? $endpoints->gateway.'/'
                   : null;

        # Adding forward slash if version is provided
        $version = isset($endpoints->version)
                   ? $endpoints['version'].'/'
                   : null;

        $resource = $endpoints->resource ?? null;
        $method   = $request->method;

        $path = $resources->getResourcePath();

        return $path.$gateway.$version.$resource.'.'.$method.'.php';
    }

    private static function map (
        array $data,
        Object $object
        )
    {
        foreach ($data as $key => $value) {
            $object->$key = htmlspecialchars($value);
        }
    }
}
