<?php

namespace packages\Domain\User\ValueObjects;

use Exception;

class UserAttribute
{
    /** @var int  @attribute*/
    private int $attribute;

    public function __construct(int $attribute)
    {
        if(!$this->isRegex($attribute)) throw new Exception('適切な値ではありません');
        $this->attribute = (int) $attribute;
    }


    /**
     * ファクトリーメソッド
     * @param int $attribute
     * @param self
    */
    public static function reconstruct(int $attribute)
    {
        return new self($attribute);
    }
    
    public function isRegex(int $attribute): bool
    {
        if(preg_match("/^[0-1]+$/", $attribute)) return true;

        return false;
    }

    public function getValue(): int
    {
        return $this->attribute;
    }
}