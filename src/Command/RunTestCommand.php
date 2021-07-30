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
        $orderId = Order::ID;

        // The Order is loaded directly via the DM. The return document is an Order object, as expected. The Order
        // object has a customer property that contains a Proxy<Customer> object.
        /** @var Order $order */
        $order = $this->documentManager->getRepository(Order::class)->find($orderId);

        // Fetch a list of Customers from the DB. Any customer object that was referenced in the above order is still
        // a proxy object, however it will not have the defaults set for the un-managed $domainEvents property.
        $customers = $this->documentManager->getRepository(Customer::class)->findAll();

        /** @var Customer $customer */
        foreach ($customers as $customer) {
            $customer->doSomeUpdate(); // This will trigger an error as we try to append to the non-existing $domainEvents property
            var_dump($customer->getEvents());
        }

        return 0;
    }
}
