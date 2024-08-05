<?php

namespace App\Dto\Ares;

class AdresaDto
{
    public function __construct(
        public ?string $kodStatu,
        public ?string $nazevStatu,
        public int|string|null $kodKraje,
        public ?string $nazevKraje,
        public int|string|null $kodOkresu,
        public ?string $nazevOkresu,
        public int|string|null $kodObce,
        public ?string $nazevObce,
        public int|string|null $kodSpravnihoObvodu,
        public ?string $nazevSpravnihoObvodu,
        public int|string|null $kodMestskehoObvodu,
        public ?string $nazevMestskehoObvodu,
        public int|string|null $kodMestskeCastiObvodu,
        public int|string|null $kodUlice,
        public ?string $nazevMestskeCastiObvodu,
        public ?string $nazevUlice,
        public int|string|null $cisloDomovni,
        public ?string $doplnekAdresy,
        public int|string|null $kodCastiObce,
        public int|string|null $cisloOrientacni,
        public ?string $cisloOrientacniPismeno,
        public ?string $nazevCastiObce,
        public int|string|null $kodAdresnihoMista,
        public int|string|null $psc,
        public ?string $textovaAdresa,
        public ?string $cisloDoAdresy,
        public bool $standardizaceAdresy,
        public ?string $pscTxt,
        public int|string|null $typCisloDomovni,
    ) {
    }
}
