<?php

namespace packages\Domain\User\ValueObjects;

use Exception;
use Illuminate\Support\Str;

class FamilyId
{
    /** @var string $familyId */
    private string $familyId;

    public function __construct(
        string $familyId = null
    )
    {
        //if(!$this->isInt($familyId) && $this->isNull($familyId)) throw new Exception('家族Idが適切な値ではありません');

        if(is_null($familyId)) $this->familyId = $familyId;
        
        $this->isString($familyId)
            ? $this->familyId = $familyId
            : throw new \Exception('適切な値ではありません');
    }

    /**
     * ファクトリーメソッド
     * @param string $familyId
     * @return self
     */
    public static function reconstruct(string $familyId): self
    {
        $value = new self();
        $value->familyId = $familyId;
        
        return $value;
    }

    public function isString($familyId): bool
    {
        return is_string($familyId);
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

    /**
     * if familyId is null, create new familyId
     * 
     * @return string UUID
     */
    public function createId(): string
    {
        if($this->familyId) throw new \Exception('すでにidは生成されています');

        return (string) Str::orderedUuid();
    }

    /**
     * getter
     *
     * @return string
     */
    public function getId(): string
    {
        if(is_null($this->familyId))
            throw new \Exception('Idは生成されてません。createメソッドを使用してください'); 
        
        return $this->familyId;
    }
}