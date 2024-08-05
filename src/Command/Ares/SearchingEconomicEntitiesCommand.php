<?php

namespace App\Command\Ares;

use App\Exception\AresHttpError;
use App\Service\CompanyService;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Validation;

#[AsCommand(
    name: 'app:ares:searching-economic-entities',
    description: 'Searching Economic Entities in ARES.',
)]
class SearchingEconomicEntitiesCommand extends Command
{
    public function __construct(private readonly CompanyService $companyService)
    {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $question = (new Question('Please enter CRN (Company registration number) to search for an economic entity in ARES (e.g. 01569651): '))
            ->setNormalizer(fn (?string $value): string => $value ?? '')
            ->setValidator(Validation::createCallable(
                null,
                new Assert\NotBlank(message: 'CRN of economic entity cannot be empty'),
                new Assert\Regex(
                    pattern: '/^[0-9]{8}$/',
                    message: 'CRN of economic entity should match regular expression \'{{ pattern }}\'',
                ),
            ))
            ->setMaxAttempts(5)
        ;

        $crn = $this->getHelper('question')->ask($input, $output, $question);

        try {
            $entity = $this->companyService->getEconomicEntity($crn);

            if ($entity) {
                $io->success($entity->obchodniJmeno);
            } else {
                $io->warning('Economic entity in ARES not found');
            }
        } catch (AresHttpError $e) {
            $io->error(explode('|', $e->getMessage()));
        }

        return Command::SUCCESS;
    }
}
