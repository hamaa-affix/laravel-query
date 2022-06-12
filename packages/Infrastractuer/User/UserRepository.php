<?php

namespace packages\Infrastractuer\User;

use App\Models\Family;
use App\Models\User;
use packages\Domain\User\Entities\UserModel;
use packages\Domain\User\Entities\UserRepositoryInterface;
use packages\Domain\User\ValueObjects\FamilyId;

class UserRepository implements UserRepositoryInterface
{
    /**
     * user登録を行います
     * 
     * @return UserModel
     */
    public function register(UserModel $user): UserModel
    {
        return User::create([
            'id' => $user->getUserId(),
            'fist_name' => $user->getFirstName(),
            'last_name' => $user->getLastName(),
            'age' => $user->getAge(),
            'tel' => $user->getTel(),
            'email' => $user->getEmail(),
            'password' => $user->getPassword(),
            'attribute' => $user->getAttribute(),
            'comment' => $user->getComment(),
            'family_id' => $user->getFamilyId(),
        ]);
    }

    /**
     * familyデータを作成します
     * 
     * @return FamilyId
     */
    public function createFamilyId(): FamilyId
    {
        $family = Family::create();

        return new FamilyId($family->id);
    }
}