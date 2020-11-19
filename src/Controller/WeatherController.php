<?php declare(strict_types=1);

namespace App\Controller;

use App\Model\Request\WeatherRequest;
use App\Service\Validator;
use App\Service\WeatherService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 *
 */
class WeatherController extends AbstractController
{
    /**
     * @Route("/weathers", name="weather")
     */
    public function getWeather(WeatherService  $weatherService, Validator $validator, Request $request): Response
    {
        $requestData = json_decode($request->getContent(), true);
        $inputData = $validator->validate($requestData, WeatherRequest::class);

        $weatherData = $weatherService->get([
            'api_key' => $inputData['api_key'],
            'city' => $inputData['city'],
        ]);

        return $this->json([
            'data' => $weatherData,
        ]);
    }
}
