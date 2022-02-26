<?php

namespace packages\Domain\User\ValueObjects;

use Exception;
use Illuminate\Support\Str;

class UserId
{
    /** @var string $userId */
    private string $userId;

    public function __construct(
        string $userId = null
    )
    {
        if(is_null($userId)) $this->userId = null;

        $this->isString($userId)
            ? $this->userId = $userId
            : throw new \Exception('有効な値ではありません'); 
    }

    /**
     * 別オブジェジェットを生成する場合のファクトリーメソッド
     * @param string $userId
     * @return self
     */
    public static function reconstruct(string $userId): self
    {
        $value =  new self();
        $value->userId = $userId;

        return $value;
    }

    private function isString(string $userId): bool
    {
        return is_string($userId);
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
     *getter
     * @return string
     */
    public function getId(): string
    {
        if(!!$this->userId) return $this->createId();

        return $this->userId;
    }

    /**
     * create userId if UserId not fuond or null
     * 
     * @return string UUID
     */
    public function createId(): string
    {
        if($this->userId) throw new \Exception('すでにidは作成済みです');

        return (string) Str::orderedUuid();
    }
}