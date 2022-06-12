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
        if ($familyId) return $familyId;
        $this->familyId = (string) Str::uuid();
    }

    public function id(): string
    {
        return $this->familyId;
    }
}
