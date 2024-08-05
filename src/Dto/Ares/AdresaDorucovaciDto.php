<?php

namespace App\Dto\Ares;

class AdresaDorucovaciDto
{
    public function __construct(
        public ?string $radekAdresy1,
        public ?string $radekAdresy2,
        public ?string $radekAdresy3,
    ) {
    }
}
