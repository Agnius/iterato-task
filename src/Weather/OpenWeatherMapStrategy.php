<?php declare(strict_types=1);

namespace App\Weather;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class OpenWeatherMapStrategy
{
    /** @var array $provider */
    private $provider;

    /** @var array $data */
    private $data;

    /** @var HttpClientInterface $httpClient */
    private $httpClient;

    /**
     * OpenWeatherMapStrategy constructor.
     * @param array $provider
     * @param $data
     * @param HttpClientInterface $httpClient
     */
    public function __construct(array $provider, array $data, HttpClientInterface $httpClient)
    {
        $this->provider = $provider;
        $this->data = $data;
        $this->httpClient = $httpClient;
    }

    /**
     * @return array
     * @throws \Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface
     */
    public function execute(): array
    {
        $request = $this->httpClient->request('GET', "weather?q={$this->data['city']}&appid={$this->data['api_key']}", [
            'base_uri' => "https://{$this->provider['url']}/"
        ]);

        return $request->toArray();
    }
}