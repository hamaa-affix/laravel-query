<?php

namespace packages\Domain\UserService;

use packages\Domain\User\ValueObjects\UserId;
use packages\Domain\User\Entities\UserModel;
use packages\Domain\User\Entities\UserRepositoryInterface;
use packages\Domain\User\ValueObjects\EmailAddress;
use packages\Domain\User\ValueObjects\TelephoneNumber;
use packages\Domain\User\ValueObjects\Age;
use packages\Domain\User\ValueObjects\FamilyId;
use packages\Domain\User\ValueObjects\UserAttribute;
use packages\Domain\User\ValueObjects\UserComment;
use packages\Domain\User\ValueObjects\UserFirstName;
use packages\Domain\User\ValueObjects\UserLasttName;

final class UserRefisterService
{
    /** @var UserRepositoryInterface */
    private UserRepositoryInterface $userRepository;

    /**
     *
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    
    /**
     * familydataを作成し,userデータを登録します
     * 
     * @return Usermodel
     */
    public function refister(
        UserId $userId,
        UserFirstName $firstName,
        UserLasttName $lastName,
        Age $age,
        TelephoneNumber $tel,
        EmailAddress $email,
        string $password,
        UserAttribute $attribute,
        UserComment $comment,
        FamilyId $familyId
    ): UserModel
    {

        $familyId = $this->userRepository->createFamilyId();

        $user = UserModel::create(
            $userId,
            $firstName,
            $lastName,
            $age,
            $tel,
            $email,
            $password,
            $attribute,
            $comment,
            $familyId
        );

        $user = $this->userRepository->register($user);

        return $user;
    }
}