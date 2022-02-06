<?php

namespace packages\Domain\Entities\User;

use packages\Domain\Entities\User\UserModel;
use packages\Domain\ValueObjects\User\FamilyId;

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