<?php

namespace packages\Domain\User\ValueObjects;

use Exception;

class UserAttribute
{
    /** @var int  @attribute*/
    private int $attribute;

    private const MAX = 1;
    private const MIN = 0;

    public function __construct(int $attribute)
    {
        if ($attribute > self::MAX && $attribute < self::MIN)
            throw new Exception('無効な値です');
        if(!$this->isRegex($attribute)) throw new Exception('適切な値ではありません');

        $this->attribute = (int) $attribute;
    }

    public function isRegex(int $attribute): bool
    {
        if(preg_match("/^[0-1]+$/", $attribute)) return true;

        return false;
    }

    public function value(): string
    {
        switch ($this->attribute) {
            case 0:
                return 'お父さん';
            case 1:
                return ' お母さん';
        }
    }
}
