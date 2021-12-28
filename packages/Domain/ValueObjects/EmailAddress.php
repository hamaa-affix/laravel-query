<?php

namespace packages\Domain\ValueObjects;

use Exception;

class EmailAddress
{
    /** @var $email */
    private string $email;

    public function __construct(string $email)
    {
        if($this->isMailable($email)) throw new Exception('メールアドレスの形式が正しく合いません');

        $this->email = $email;
    }

    /**
     * repositoryなどで使用する,ファクトリーメソッド
     * @param string $emailAddress
     */
    public static function reconstruct(string $email): EmailAddress
    {
        return new self($email);
    }

    /**
     *  正規表現によって、emailアドレスであるかを評価します。
     */
    public function isMailable($email): bool
    {
        $pattern = '/\A([0-9a-z\+_\-]+)(\.[a-z0-9\+_\-]+){64}*@([a-z0-9\-]+\.)+[a-z]{2, 6}\z/ui';
        if(!preg_match($pattern, $email)) return false;

        return true;
    }
}