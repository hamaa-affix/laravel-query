<?php

namespace packages\Domain\User\ValueObjects;

use Exception;

class UserFirstName
{
    /** @var string  @userFirstName*/
    private string $firstName;

    private const MAX = 65;
    private const MIN = 0;

    public function __construct(string $firstName)
    {
        if (mb_strlen($firstName) < self::MIN) throw new Exception('名前は１文字以上で入力してください');
        if (mb_strlen($firstName) > self::MAX) throw new Exception('名前は最大64文字です');
        $this->firstName = $firstName;
    }

    public function value(): string
    {
        return $this->firstName;
    }
}
