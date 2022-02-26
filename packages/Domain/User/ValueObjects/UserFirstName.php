<?php

namespace packages\Domain\User\ValueObjects;

use Exception;

class UserFirstName
{
    /** @var string  @userFirstName*/
    private string $userFirstName;

    public function __construct(string $userFirstName)
    {
        if($this->isUserFirstName($userFirstName)) throw new Exception('名前は最大64文字です');
        $this->userFirstName = $userFirstName;
    }


    /**
     * ファクトリーメソッド
     * @param string $userFirstName
     * @param self
    */
    public static function reconstruct(string $userFirstName)
    {
        return new self($userFirstName);
    }


    /**
     * 名前は64文字以内であること。
     * @param string $userFirstName
     * @return bool
     */
    public function isUserFirstName(string $userFirstName): bool
    {
        return !! $userFirstName < 65; 
    }

    public function getFirstName(): string
    {
        return $this->userFirstName;
    }

    /**
     * getter
     * 
     * @return string
     */
    public function getValue(): string
    {
        return $this->userFirstName;
    }
}