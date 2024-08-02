<?php

namespace App\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:integers-iterator',
    description: 'Iterates integers from 1 to 100 and prints result according to specified conditions.',
)]
class IntegersIteratorCommand extends Command
{
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        for ($i = 1; $i <= 100; ++$i) {
            if (!($i % 15)) {
                $io->writeln('SuperFaktura');
            } elseif (!($i % 5)) {
                $io->writeln('Faktura');
            } elseif (!($i % 3)) {
                $io->writeln('Super');
            } else {
                $io->writeln($i);
            }
        }

        return Command::SUCCESS;
    }
}
