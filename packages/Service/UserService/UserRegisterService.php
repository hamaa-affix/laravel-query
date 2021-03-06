<?php

namespace packages\Service\UserService;

use packages\Domain\User\Entities\UserModel;
use packages\Domain\User\Entities\UserRepositoryInterface;
use packages\Domain\User\ValueObjects\EmailAddress;
use packages\Domain\User\ValueObjects\TelephoneNumber;
use packages\Domain\User\ValueObjects\Age;
use packages\Domain\User\ValueObjects\UserAttribute;
use packages\Domain\User\ValueObjects\UserComment;
use packages\Domain\User\ValueObjects\UserFirstName;
use packages\Domain\User\ValueObjects\UserLastName;

final class UserRegisterService
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
    public function handle(
        UserFirstName $firstName,
        UserLastName $lastName,
        Age $age,
        TelephoneNumber $tel,
        EmailAddress $email,
        string $password,
        UserAttribute $attribute,
        UserComment $comment = null,
    ): UserModel
    {

        $familyId = $this->userRepository->createFamilyId();

        $user = UserModel::formInit(
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

        return $this->userRepository->register($user);

        
    }
}