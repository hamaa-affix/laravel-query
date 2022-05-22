<?php

namespace packages\Domain\User\ValueObjects;

use Exception;

class Age
{
    /** @var int  $age*/
    private int $age;

    private const MAX = 100;
    private const MIN = 0;

    public function __construct(int $age)
    {
        if($this->isRange($age) && !$this->isInt($age))
            throw new Exception('年齢は0 ~ 100までの整数値で登録してください');

        $this->age = $age;
    }

    /**
     * 整数値であること
     * @param int $age
     * @return bool
     */
    public function isInt(int $age): bool
    {
        if(preg_match("/^[0-9]+$/", $age)) return true;
        return false;
    }

    /**
     * 0 ~ 100までの整数値であること
     * @param int $age
     * @return bool
     */
    public function isRange(int $age): bool
    {
        if($age > self::MIN && $age < self::MAX) return true;

        return false;
    }

    public function value(): int
    {
        return $this->age;
    }
}
