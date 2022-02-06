<?php

namespace packages\Domain\UserService;

use packages\Domain\ValueObjects\User\UserId;
use packages\Domain\Entities\User\UserModel;
use packages\Domain\Entities\User\UserRepositoryInterface;
use packages\Domain\ValueObjects\EmailAddress;
use packages\Domain\ValueObjects\TelephoneNumber;
use packages\Domain\ValueObjects\User\Age;
use packages\Domain\ValueObjects\User\FamilyId;
use packages\Domain\ValueObjects\User\UserAttribute;
use packages\Domain\ValueObjects\User\UserComment;
use packages\Domain\ValueObjects\User\UserFirstName;
use packages\Domain\ValueObjects\User\UserLasttName;

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