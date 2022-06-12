<?php

namespace packages\Domain\User\ValueObjects;

use Exception;

class UserLastName
{
    /** @var string  lastName*/
    private string $lastName;

    private const MAX = 65;
    private const MIN = 0;

    public function __construct(string $lastName)
    {
        if(mb_strlen($lastName) < self::MIN) throw new Exception('苗字は１文字以上で入力してください');
        if(mb_strlen($lastName) > self::MAX) throw new Exception('苗字は64文字以下で入力してください');
        $this->lastName = $lastName;
    }

    public function value(): string
    {
        return $this->lastName;
    }
}
