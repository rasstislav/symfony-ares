<?php

namespace App\Dto\Ares;

class EkonomickySubjektZakladDto
{
    public function __construct(
        public string $ico,
        public string $obchodniJmeno,
        public AdresaDto $sidlo,
        public string $pravniForma,
        public ?string $financniUrad,
        public \DateTimeInterface $datumVzniku,
        public ?\DateTimeInterface $datumZaniku,
        public \DateTimeInterface $datumAktualizace,
        public ?string $dic,
    ) {
    }
}
