<?php

declare(strict_types=1);

namespace App\Command;

use App\Document\Customer;
use App\Document\Order;
use Doctrine\ODM\MongoDB\DocumentManager;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class RunTestCommand extends Command
{
    protected static $defaultName = 'app:run';

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
        /** @var Order $order */
        $orderId = Order::ID;
        $order = $this->documentManager->getRepository(Order::class)->find($orderId);

        // pretend this is fired from an event
        $customers = $this->documentManager->getRepository(Customer::class)->findAll();

        /** @var Customer $customer */
        foreach ($customers as $customer) {
            $customer->doSomeUpdate();
            var_dump($customer->getEvents());
        }

        return 0;
    }
}
