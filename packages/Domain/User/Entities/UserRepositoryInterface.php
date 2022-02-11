<?php

namespace packages\Domain\User\Entities;

use packages\Domain\User\Entities\UserModel;
use packages\Domain\User\ValueObjects\FamilyId;

interface UserRepositoryInterface
{
    /**
     * userの登録を行います
     * 
     * @return UserModel
     */
    public function register(UserModel $user): UserModel;

    /**
     * familyデータを作成します
     * 
     * @return FamilyId
     */
    public function createFamilyId(): FamilyId;
}