<?php

namespace App\Client;

use Symfony\Component\DependencyInjection\Attribute\AsDecorator;

#[AsDecorator('ares_economic_entities.client')]
class AresEconomicEntitiesClient extends ApiClient
{
    public function getEconomicEntity(string $crn): ?array
    {
        return $crn ? $this->get('ekonomicke-subjekty/'.$crn) : null;
    }
}
