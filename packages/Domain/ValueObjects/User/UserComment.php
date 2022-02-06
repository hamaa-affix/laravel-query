<?php

namespace packages\Domain\ValueObjects\User;

use Exception;

class UserComment
{
    private string $comment;

    public function __construct(string $comment)
    {
        if($this->isString($comment) && $this->maxLength($comment)) throw new Exception('説明文が適切な形式ではありません');
        $this->comment = $comment;
    }

    /**
     * ファクトリーメソッド
     * @param string $comment
     * @param self
    */
    public static function reconstruct(string $comment): self
    {
        return new self($comment);
    }


    /**
     * 文字列であること？？
     * @param string $comment
     * @return bool
     */
    public function isString(string $comment): bool
    {
        return is_string($comment);
    }

    /**
     * max length 500
     * @param string $comment
     * @return bool
     */
    public function maxLength(string $comment): bool
    {
        if(mb_strlen($comment) >= 500) return true;

        return false;
    }

}
