<?php declare(strict_types=1);

namespace App\Weather;

use Symfony\Component\HttpKernel\HttpKernel;
use Symfony\Contracts\HttpClient\HttpClientInterface;

/**
 * Class Context
 * @package App\Weather
 */
class Context
{
    /** @var OpenWeatherMapStrategy|null $strategy */
    private $strategy = null;

    public function __construct(array $provider, array $data, HttpClientInterface $httpClient)
    {
        switch($provider['provider']) {
            case "open_weather_map":
                $this->strategy = new OpenWeatherMapStrategy($provider, $data, $httpClient);
                break;
            default:
                break;
        }
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        return (array)$this->strategy->execute();
    }

}