<?php

namespace App\Controller\Planets;


use App\Service\Planets\GetPlanetsService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class GetPlanets extends AbstractController
{

    private HttpClientInterface $client;
    private GetPlanetsService $getPlanetsService;

    public function __construct(HttpClientInterface $client, GetPlanetsService $getPlanetsService)
    {
        $this->client = $client;
        $this->getPlanetsService = $getPlanetsService;
    }

    /**
     * @Route("/planets/{id}", name="get_planets")
     * @throws TransportExceptionInterface
     */
    public function getPlanet($id): Response
    {
        $response = $this->client->request(
            'GET',
            'https://swapi.dev/api/planets/' . $id
        );

        if ($response->getStatusCode() !== 200) {
            return $this->json('Error', 400);
        }

        $planet = $this->getPlanetsService->getPlanets($id, $response->toArray());
        return $this->json($planet);
    }
}
