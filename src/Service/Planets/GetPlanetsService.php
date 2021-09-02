<?php

namespace App\Service\Planets;

class GetPlanetsService
{

    public function getPlanets($id, $array): array
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
}