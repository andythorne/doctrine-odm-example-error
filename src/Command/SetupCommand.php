<?php

declare(strict_types=1);

namespace App\Command;

use App\Document\Customer;
use App\Document\Order;
use Doctrine\ODM\MongoDB\DocumentManager;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class SetupCommand extends Command
{
    protected static $defaultName = 'app:setup';

    public function __construct(
        private DocumentManager $documentManager,
    ) {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->setDescription('Create a new order')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $customer = new Customer('Some Place');
        $order = new Order($customer);

        $this->documentManager->persist($customer);
        $this->documentManager->persist($order);
        $this->documentManager->flush();

        return 0;
    }
}
