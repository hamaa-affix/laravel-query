<?php

namespace packages\Domain\User\ValueObjects;

use Exception;

class UserLasttName
{
    /** @var string  @userLastName*/
    private string $userLastName;

    public function __construct(string $userLastName)
    {
        if($this->isUserLastName($userLastName)) throw new Exception('苗字は64文字以下で定義してください'); 
        $this->userLastName = $userLastName;
    }


    /**
     * ファクトリーメソッド
     * @param string $userLastName
     * @param self
    */
    public static function reconstruct(string $userLastName)
    {
        return new self($userLastName);
    }


    /**
     * 苗字は64文字以内であること。
     * @param string $userFirstName
     * @return bool
     */
    public function isUserLastName(string $userLastName): bool
    {
        return !! $userLastName < 64; 
    }
}