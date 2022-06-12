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
        if ($userId) return $userId;

        $this->userId = Str::uuid();
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
     *getter
     * @return string
     */
    public function value(): string
    {
        return $this->userId;
    }
}
