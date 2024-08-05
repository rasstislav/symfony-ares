<?php

namespace App\Dto\Ares;

class SeznamRegistraciDto
{
    public function __construct(
        public string $stavZdrojeVr,
        public string $stavZdrojeRes,
        public string $stavZdrojeRzp,
        public string $stavZdrojeNrpzs,
        public string $stavZdrojeRpsh,
        public string $stavZdrojeRcns,
        public string $stavZdrojeSzr,
        public string $stavZdrojeDph,
        public string $stavZdrojeSd,
        public string $stavZdrojeIr,
        public string $stavZdrojeCeu,
        public string $stavZdrojeRs,
        public string $stavZdrojeRed,
    ) {
    }
}
