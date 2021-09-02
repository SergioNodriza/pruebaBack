<?php

namespace App\Service\Planets;

use App\Entity\Planet;
use App\Exception\ConflictException;
use Doctrine\ORM\EntityManagerInterface;
use Exception;

class PostPlanetsService
{
    private EntityManagerInterface $entityManager;
    private PlanetFormatter $planetFormatter;

    public function __construct(EntityManagerInterface $entityManager, PlanetFormatter $planetFormatter)
    {
        $this->entityManager = $entityManager;
        $this->planetFormatter = $planetFormatter;
    }

    public function postPlanets($id, $name, $rotation_period, $orbital_period, $diameter): array
    {
        $planet = new Planet($id, $name);
        $planet->setRotationPeriod($rotation_period);
        $planet->setOrbitalPeriod($orbital_period);
        $planet->setDiameter($diameter);

        try {
            $this->entityManager->persist($planet);
            $this->entityManager->flush();
        } catch (Exception $exception) {
            throw ConflictException::fromSave("Planet");
        }

        return $this->planetFormatter->fromPlanet($planet);
    }
}