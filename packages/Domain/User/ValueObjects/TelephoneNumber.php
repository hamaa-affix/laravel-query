<?php

namespace packages\Domain\User\ValueObjects;

use Exception;

class TelephoneNumber
{
    /** @var string  @tel*/
    private string $tel;

    private const MIN = 0;

    public function __construct(string $tel)
    {
        if(!$this->isIntWithMaxNum($tel) && $tel < self::MIN)
            throw new Exception('電話番号は適切値ではありません');

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
        $pattern = '/^[0-9]{10,11}$/';
        if(!preg_match($pattern, $tel)) return false;

        return true;
    }

    public function value(): string
    {
        return $this->tel;
    }
}
