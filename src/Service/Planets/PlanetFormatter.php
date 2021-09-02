<?php

namespace App\Service\Planets;

use App\Entity\Planet;

class PlanetFormatter
{
    public function fromArray($id, $array): array
    {
        return [
            "id" => (int)$id,
            "name" => $array['name'],
            "rotation_period" => (int)$array['rotation_period'],
            "orbital_period" => (int)$array['orbital_period'],
            "diameter" => (int)$array['diameter'],
            "films_count" => count($array['films']),
            "created" => $array['created'],
            "edited" => $array ['edited'],
            "url" => $array['url']
        ];
    }

    public function fromPlanet(Planet $planet): array
    {
        return [
            "id" => $planet->getId(),
            "name" => $planet->getName(),
            "rotation_period" => $planet->getRotationPeriod(),
            "orbital_period" => $planet->getOrbitalPeriod(),
            "diameter" => $planet->getDiameter(),
            "films_count" => $planet->getFilmsCount(),
            "created" => $planet->getCreated(),
            "edited" => $planet->getEdited(),
            "url" => $planet->getUrl()
        ];
    }
}