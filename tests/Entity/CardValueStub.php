<?php

namespace App\Tests\Entity;

use App\Entity\CardValue;

class CardValueStub extends CardValue
{
    private $fakeId;

    public function __construct(int $id, string $name)
    {
        $this->fakeId = $id;
        parent::__construct($name);
    }

    public function getId(): int
    {
        return $this->fakeId;
    }

}
