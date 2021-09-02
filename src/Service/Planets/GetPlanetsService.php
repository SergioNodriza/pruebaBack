<?php

namespace App\Service\Planets;

class GetPlanetsService
{

    private PlanetFormatter $planetFormatter;

    public function __construct(PlanetFormatter $planetFormatter)
    {
        $this->planetFormatter = $planetFormatter;
    }

    public function getPlanets($id, $array): array
    {
        return $this->planetFormatter->fromArray($id, $array);
    }
}