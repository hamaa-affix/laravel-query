<?php

namespace packages\Domain\User\ValueObjects;

use Exception;

class FamilyId
{
    /** @var int $familyId */
    private int $familyId;

    public function __construct(int $familyId)
    {
        if(!$this->isInt($familyId) && $this->isNull($familyId)) throw new Exception('家族Idが適切な値ではありません');

        $this->familyId = $familyId;
    }

    /**
     * ファクトリーメソッド
     * @param int $familyId
     * @return self
     */
    public static function reconstruct(int $familyId): self
    {
        return new self($familyId);
    }

    /**
     * idは整数値で、正の数であること
     * 
     * @param int $familyId
     * @return bool
     */
    public function isInt(int $familyId): bool
    {
        if(preg_match("/^[0-9]+$/", $familyId)) return true;

        return false;
    }

    /**
     * nullでないこと
     * 
     * @param int $familyId
     * @return bool
     */
    public function isNull(int $familyId): bool
    {
        if(isset($familyId)) return true;
        
        return false;
    }
}