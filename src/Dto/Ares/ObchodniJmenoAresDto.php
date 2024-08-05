<?php

namespace App\Dto\Ares;

class ObchodniJmenoAresDto
{
    public function __construct(
        public ?\DateTimeInterface $platnostOd,
        public ?\DateTimeInterface $platnostDo,
        public string $obchodniJmeno,
        public bool $primarniZaznam,
    ) {
    }
}
