<?php

namespace App\Service;

use App\Dto\Ares\EkonomickySubjektDto;
use App\Exception\AresHttpError;
use Symfony\Component\PropertyInfo;
use Symfony\Component\Serializer;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class CompanyService
{
    private Serializer\Serializer $serializer;

    public function __construct(
        private readonly HttpClientInterface $aresEconomicEntitiesClient,
        private readonly CacheService $cacheService,
    ) {
        $phpDocExtractor = new PropertyInfo\Extractor\PhpDocExtractor();
        $typeExtractor = new PropertyInfo\PropertyInfoExtractor(
            typeExtractors: [
                $phpDocExtractor,
            ]
        );

        $this->serializer = new Serializer\Serializer([
            new Serializer\Normalizer\DateTimeNormalizer(),
            new Serializer\Normalizer\ObjectNormalizer(propertyTypeExtractor: $typeExtractor),
            new Serializer\Normalizer\ArrayDenormalizer(),
        ]);
    }

    /**
     * @throws AresHttpError When error occurs
     */
    public function getEconomicEntity(string $crn): ?EkonomickySubjektDto
    {
        $entity = null;

        $response = $this->cacheService->get(
            __METHOD__.'_'.$crn,
            fn (): ?array => $this->aresEconomicEntitiesClient->getEconomicEntity($crn),
        );

        if ($data = $response['data'] ?? null) {
            $entity = $this->serializer->denormalize($data, EkonomickySubjektDto::class);
        } elseif ($error = $response['error'] ?? null) {
            [
                'kod' => $errorCode,
                'popis' => $description,
                'subKod' => $errorSubCode,
                'statusCode' => $statusCode,
            ] = $error;

            throw new AresHttpError($description, $statusCode, $errorCode, $errorSubCode);
        }

        return $entity;
    }
}
