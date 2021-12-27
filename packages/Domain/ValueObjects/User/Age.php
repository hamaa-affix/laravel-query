<?php

namespace packages\Domain\ValueObjects\User;

use Exception;

class Age
{
    /** @var int  $age*/
    private int $age;

    public function __construct(int $age)
    {
        if($this->isRange($age) && $this->isInt($age)) throw new Exception('年齢は0 ~ 100までの整数値で登録してください'); 
        $this->age = $age;
    }


    /**
     * ファクトリーメソッド
     * @param int $age
     * @param self
    */
    public static function reconstruct(int $age)
    {
        return new self($age);
    }


    /**
     * 整数値であること
     * @param int $age
     * @return bool
     */
    public function isInt(int $age): bool
    {
        return is_int($age); 
    }

    /**
     * 0 ~ 100までの整数値であること
     * @param int $age
     * @return bool
     */
    public function isRange(int $age): bool
    {
        if($age > 0 && $age < 100) return true;

        return false;
    }
}