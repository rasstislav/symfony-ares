<?php

namespace App\Dto\Ares;

class EkonomickySubjektDalsiUdajeDto
{
    public function __construct(
        /** @var ObchodniJmenoAresDto[] */
        public array $obchodniJmeno,
        /** @var AdresaAresDto[] */
        public array $sidlo,
        public string $pravniForma,
        public ?string $spisovaZnacka,
        public string $datovyZdroj,
    ) {
    }
}
