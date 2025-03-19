<?php

namespace App\Core\Provider;

use App\Core\Denormalizer\MovieDenormalizer;
use App\Core\Entity\Movie;
use GuzzleHttp\ClientInterface;
use Illuminate\Support\Facades\Cache;

class CacheMovieProvider implements MovieProvider
{
    private const CACHE_EXPIRATION = 3600; // 1 hour
    private array $configuration;
    private ClientInterface $httpClient;
    private MovieDenormalizer $movieDenormalizer;

    public function __construct(array $configuration, ClientInterface $httpClient, MovieDenormalizer $movieDenormalizer)
    {
        $this->configuration = $configuration;
        $this->httpClient = $httpClient;
        $this->movieDenormalizer = $movieDenormalizer;
    }

    public function getMovieById(string $id): ?Movie
    {
        return Cache::remember("movie_$id", self::CACHE_EXPIRATION, function () use ($id) {
            $movieResponse = $this->httpClient->request(
                'GET',
                $this->configuration['urls']['get_movie'] . '?i=' . $id . '&apikey=' . $this->configuration['api_key']
            );

            if ($movieResponse->getStatusCode() === 200) {
                $data = json_decode($movieResponse->getBody()->getContents(), true);

                return $this->movieDenormalizer->denormalize($data);
            }

            return Cache::get("movie_$id");
        });
    }
}
