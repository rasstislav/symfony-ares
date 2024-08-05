<?php

namespace App\Dto\Ares;

class EkonomickySubjektDto extends EkonomickySubjektZakladDto
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
        public string $icoId,
        public AdresaDorucovaciDto $adresaDorucovaci,
        public SeznamRegistraciDto $seznamRegistraci,
        public string $primarniZdroj,
        /** @var EkonomickySubjektDalsiUdajeDto[] */
        public array $dalsiUdaje,
        public array $czNace,
        public ?string $subRegistrSzr,
        public ?string $dicSkDph,
    ) {
        parent::__construct(
            $ico,
            $obchodniJmeno,
            $sidlo,
            $pravniForma,
            $financniUrad,
            $datumVzniku,
            $datumZaniku,
            $datumAktualizace,
            $dic,
        );
    }
}
