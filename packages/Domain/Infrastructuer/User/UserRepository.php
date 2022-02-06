<?php

namespace packages\Domain\Infrastructuer;

use App\Models\Family;
use App\Models\User;
use packages\Domain\Entities\User\UserModel;
use packages\Domain\Entities\User\UserRepositoryInterface;
use packages\Domain\ValueObjects\User\FamilyId;

class UserRepository implements UserRepositoryInterface
{
    /**
     * user登録を行います
     * 
     * @return UserModel
     */
    public function register(UserModel $user): UserModel
    {
        $userDta = User::create([
            'first_name' => $user->getFirstName(),
            'last_name' => $user->getLastName(),
        ]);

        return UserModel::create(
            $userDta->userId,
            $userDta->firstName,
            $userDta->lastName,
            $userDta->age,
            $userDta->tel,
            $userDta->email,
            $userDta->password,
            $userDta->attribute,
            $userDta->comment,
            $userDta->familyId
        );
    }

    /**
     * familyデータを作成します
     * 
     * @return FamilyId
     */
    public function createFamilyId(): FamilyId
    {
        $familyId = Family::create();
        
        return FamilyId::reconstruct($familyId);
    }
}