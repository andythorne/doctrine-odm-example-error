<?php

declare(strict_types=1);

namespace App\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations\Document;
use Doctrine\ODM\MongoDB\Mapping\Annotations\Id;
use Doctrine\ODM\MongoDB\Mapping\Annotations\ReferenceOne;
use MongoDB\BSON\ObjectId;

/**
 * @Document()
 */
class Order
{
    public const ID = '610419a277d50f7609139543';

    /**
     * @Id()
     */
    private string $id;

    /**
     * @ReferenceOne(targetDocument=Customer::class, storeAs="ref")
     */
    private Customer $customer;

    public function __construct(Customer $customer)
    {
        $this->id = (string) new ObjectId(self::ID);
        $this->customer = $customer;
    }
}
