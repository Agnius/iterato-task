<?php


namespace App\Service;

use App\Weather\Context;
use Symfony\Contracts\HttpClient\HttpClientInterface;

/**
 * Class WeatherService
 * @package App\Service
 */
class WeatherService
{
    private $httpClient;

    /**
     * WeatherService constructor.
     * @param HttpClientInterface $httpClient
     */
    public function __construct(HttpClientInterface $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    /**
     * @param array $data
     * @return Context
     */
    public function get(array $data): array
    {
        $provider = $this->getProviderData();

        $context = new Context($provider, $data, $this->httpClient);

        return $context->getData();
    }

    /**
     *
     */
    private function getProviderData(): array
    {
        return [
            'provider' => $_ENV['WEATHER_API_PROVIDER'],
            'url' => $_ENV['WEATHER_API_URL'],
            'version' => $_ENV['WEATHER_API_VERSION'],
        ];
    }
}