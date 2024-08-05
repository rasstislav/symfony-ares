<?php

namespace App\Dto\Ares;

class AdresaAresDto
{
    public function __construct(
        public AdresaDto $sidlo,
        public bool $primarniZaznam,
        public ?\DateTimeInterface $platnostOd,
        public ?\DateTimeInterface $platnostDo,
    ) {
    }
}
