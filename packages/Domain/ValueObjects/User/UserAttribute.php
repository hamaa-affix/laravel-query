<?php

namespace packages\Domain\ValueObjects\User;

use Exception;

class UserAttribute
{
    /** @var int  @attribute*/
    private string $attribute;

    public function __construct(int $attribute)
    {
        if($this->isInt($attribute) && $this->isRegex($attribute)) throw new Exception('名前は最大64文字です');
        $this->$attribute = $this->makeAttribute($attribute);
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


    /**
     * 整数値であること
     * @param int $attribute
     * @return bool
     */
    public function isInt(int $attribute): bool
    {
        return is_int($attribute);
    }

    
    public function isRegex(int $attribute): bool
    {
        $pattern = '/^[0-2]$/';
        if(!preg_match($pattern, $attribute)) return false;

        return true;
    }

    /**
     * attributeの値から、user属性を返却します
     * @param int $attribute
     * @return string
     */
    public function makeAttribute(int $attribute): string
    {
        switch ($attribute){
            case 0:
                return '父';
            case 1:
                return '母';
            case 2:
                return '子';
        }
    }
}