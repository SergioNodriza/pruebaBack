<?php

namespace App\Controller\Planets;

use App\Service\Planets\PostPlanetsService;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Routing\Annotation\Route;

class PostPlanet extends AbstractController
{
    private PostPlanetsService $postPlanetsService;

    public function __construct(PostPlanetsService $postPlanetsService)
    {
        $this->postPlanetsService = $postPlanetsService;
    }

    /**
     * @Route("/planets", name="post_planets", methods={"POST"})
     */
    public function index(Request $request): Response
    {
        $keysArray = array_keys($request->toArray());
        foreach ($keysArray as $key) {
            if (!in_array($key, ['id', 'name', 'rotation_period', 'orbital_period', 'diameter'], true)) {
                throw new BadRequestHttpException('Wrong Body Format');
            }
        }

        $id = $request->toArray()['id'];
        $name = $request->toArray()['name'];
        $rotation_period = $request->toArray()['rotation_period'] ?? null;
        $orbital_period = $request->toArray()['orbital_period'] ?? null;
        $diameter = $request->toArray()['diameter'] ?? null;

        $planet = $this->postPlanetsService->postPlanets($id, $name, $rotation_period, $orbital_period, $diameter);
        return $this->json($planet);
    }
}
