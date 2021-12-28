<?php

namespace packages\Domain\ValueObjects\User;

use Exception;

class UserId
{
    /** @var int $userId */
    private int $userId;

    public function __construct(int $userId)
    {
        if(self::isInt($userId) && self::isUnsined($userId)) throw new Exception('userIdが正しくありません'); 

        $this->userId = $userId;
    }

    /**
     * 別オブジェジェットを生成する場合のファクトリーメソッド
     * @param int $userId
     * @return self
     */
    public static function reconstruct(int $userId): self
    {
        return new self($userId);
    }
    
    /**
     * userIdが一意であること
     */
    // public function uniqId(int $userId): bool
    // {
    //     if($userId){}
    // }

    public static function isUnsined(int $userId): bool
    {
        return $userId > 0;
    }

    /**
     * 値が不変であること
     */
    // public function equal(): bool
    // {
    //     id($this->userId === ) 
    //     return 
    // }

    /**
     * int型であること
     */
    public static function isInt(int $userId): bool
    {
        return is_int($userId);
    }

    /**
     *getter
     * @return integer
     */
    public function getId(): int
    {
        return $this->userId;
    }
}