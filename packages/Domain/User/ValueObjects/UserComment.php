<?php

namespace packages\Domain\User\ValueObjects;

use Exception;

class UserComment
{
    private string $comment;

    private const MAX = 500;

    public function __construct(string $comment)
    {
        if (mb_strlen($comment) > self::MAX) throw new Exception('自己紹介文は500文字を超えて入力することはできません');
        $this->comment = $comment;
    }

    public function value(): string
    {
        return $this->comment;
    }
}
