<?php
namespace App\Core\Entity\Simple;

use App\Core\Base\Arrayable;
use App\Core\Entity\Movie as MovieInterface;

class Movie implements MovieInterface, Arrayable
{
    private string $imdbId;
    private string $title;
    private int $year;
    private string $runtime;
    private string $genre;
    private string $director;
    private string $actors;
    private string $plot;
    private string $poster;

    public function __construct(
        string $imdbId,
        string $title,
        int $year,
        string $runtime,
        string $genre,
        string $director,
        string $actors,
        string $plot,
        string $poster
    ) {
        $this->imdbId = $imdbId;
        $this->title = $title;
        $this->year = $year;
        $this->runtime = $runtime;
        $this->genre = $genre;
        $this->director = $director;
        $this->actors = $actors;
        $this->plot = $plot;
        $this->poster = $poster;
    }

    public function getImdbId(): string
    {
        return $this->imdbId;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getYear(): int
    {
        return $this->year;
    }

    public function setYear(int $year): void
    {
        $this->year = $year;
    }

    public function getRuntime(): string
    {
        return $this->runtime;
    }

    public function setRuntime(string $runtime): void
    {
        $this->runtime = $runtime;
    }

    public function getGenre(): string
    {
        return $this->genre;
    }

    public function setGenre(string $genre): void
    {
        $this->genre = $genre;
    }

    public function getDirector(): string
    {
        return $this->director;
    }

    public function setDirector(string $director): void
    {
        $this->director = $director;
    }

    public function getActors(): string
    {
        return $this->actors;
    }

    public function setActors(string $actors): void
    {
        $this->actors = $actors;
    }

    public function getPlot(): string
    {
        return $this->plot;
    }

    public function setPlot(string $plot): void
    {
        $this->plot = $plot;
    }

    public function getPoster(): string
    {
        return $this->poster;
    }

    public function setPoster(string $poster): void
    {
        $this->poster = $poster;
    }

    public function toArray(): array
    {
        return [
            'imdbID' => $this->imdbId,
            'title' => $this->title,
            'year' => $this->year,
            'runtime' => $this->runtime,
            'genre' => $this->genre,
            'director' => $this->director,
            'actors' => $this->actors,
            'plot' => $this->plot,
            'poster' => $this->poster,
        ];
    }
}
