<?php

namespace packages\Domain\ValueObjects;

use Exception;

class TelephoneNumber
{
    /** @var string  @tel*/
    private string $tel;

    public function __construct(string $tel)
    {
        if($this->isIntWithMaxNum($tel)) throw new Exception('電話番号は適切値ではありません');
        $this->tel = $tel;
    }


    /**
     * ファクトリーメソッド
     * @param string $tel
     * @param self
    */
    public static function reconstruct(string $tel)
    {
        return new self($tel);
    }


    /**
     * 10 ~ 11の整数値であること
     * @param string $tel
     * @return bool
     */
    public function isIntWithMaxNum(string $tel): bool
    {
        $pattern = '/^[0-9]{10, 11}*$/';
        if(!preg_match($pattern, $tel)) return false; 

        return true;
    }
}