<?php
namespace App\Core\Entity;

interface Movie
{
    public function getImdbId(): string;

    public function getTitle(): string;

    public function setTitle(string $title): void;

    public function getYear(): int;

    public function setYear(int $year): void;

    public function getRuntime(): string;

    public function setRuntime(string $runtime): void;

    public function getGenre(): string;

    public function setGenre(string $genre): void;

    public function getDirector(): string;

    public function setDirector(string $director): void;

    public function getActors(): string;

    public function setActors(string $actors): void;

    public function getPlot(): string;

    public function setPlot(string $plot): void;

    public function getPoster(): string;

    public function setPoster(string $poster): void;

    public function toArray();
}
