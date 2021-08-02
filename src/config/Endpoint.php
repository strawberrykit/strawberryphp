<?php

declare(strict_types=1);

namespace strawberrykit\strawberryphp\config;

class Endpoint
{

    private $structure = '/method/resource';

    public function setEndpoint(string $structure)
    {
        $this->structure = $structure;
    }

    public function mapEndpoint(array $uris)
    {
        $structures = explode('/', $this->structure);
        $i=1;
        foreach ($structures as $structure) {
            if ($structure!=='') {
                $uri = $uris[$i] ?? 'undefined';
                $this->$structure = (explode('?', $uri))[0];
                $i++;
            }
        }
        return $this;
    }

}
