<?php

declare(strict_types=1);

namespace App\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations\Document;
use Doctrine\ODM\MongoDB\Mapping\Annotations\Field;
use Doctrine\ODM\MongoDB\Mapping\Annotations\Id;

/**
 * @Document()
 */
class Customer
{
    public const ID = '610419a277d50f7609139542';

    /** @Id() */
    private string $id;

    /** @Field() */
    private string $name;

    private array $domainEvents = [];

    public function __construct(string $name)
    {
        $this->id = self::ID;
        $this->name = $name;
    }

    public function doSomeUpdate(): void
    {
        $this->domainEvents[] = 'a new event!';
    }

    public function getEvents(): array
    {
        return $this->domainEvents;
    }
}
