<?php

namespace packages\Domain\User\Entities;

use App\Models\Family;
use packages\Domain\User\ValueObjects\UserId;
use packages\Domain\User\ValueObjects\EmailAddress;
use packages\Domain\User\ValueObjects\TelephoneNumber;
use packages\Domain\User\ValueObjects\Age;
use packages\Domain\User\ValueObjects\FamilyId;
use packages\Domain\User\ValueObjects\UserAttribute;
use packages\Domain\User\ValueObjects\UserComment;
use packages\Domain\User\ValueObjects\UserFirstName;
use packages\Domain\User\ValueObjects\UserLastName;

class UserModel
{
    /** @var UserId $userId */
    private UserId $userId;

    /** @var UserFirstName $firstName */
    private UserFirstName $firstName;

    /** @var UserLastName $lastName */
    private UserLastName $lastName;

    /** @var string $fullName */
    private string $fullName;

    /** @var Age $age */
    private Age $age;

    /** @var TelephoneNumber $tel*/
    private TelephoneNumber $tel;

    /** @var EmailAddress $email */
    private EmailAddress $email;

    /** @var string $password */
    private string $password;

    /** @var UserAttribute $attribute */
    private UserAttribute $attribute;

    /** @var UserComment $comment */
    private UserComment $comment;

    /** @var FamilyId $familyId */
    private FamilyId $familyId;

    /*
        集約。
        生成を強制させること。-> データの生合成を担保する為
        ミューテーションを記述すること -> データの変更があっても、正い値を担保できる
        モデルのドメインルールやビジネスロジックの置き場はここ
        usecaseはドメインモデルを使用するだけ。
     */

    /**
     * factory methodを使用する為にprivateにしておく
     */
    private function __construct(
        UserId $userId,
        UserFirstName $userFirstName,
        UserLastName $userLastName,
        Age $age,
        TelephoneNumber $tel,
        EmailAddress $email,
        UserAttribute $attribute,
        string $password,
        UserComment $comment,
        FamilyId $familyId,
    ){}

    /**
     * ファクトリーメソッド
     * formなどの入力値から構成されるメソッド
     *
     */
    public static function create
    (
        UserFirstName $firstName,
        UserLastName $lastName,
        Age $age,
        TelephoneNumber $tel,
        EmailAddress $email,
        string $password,
        UserAttribute $attribute,
        UserComment $comment,
    ): UserModel
    {
        return new UserModel(
            $id = new UserId(),
            $firstName,
            $lastName,
            $age,
            $tel,
            $email,
            $attribute,
            $password,
            $comment,
            $familyId = new FamilyId()
        );
    }

    /**
     * repositoryからの再構成用メソッド
     */
    public function reconstruct
    (
        UserId $id,
        UserFirstName $firstName,
        UserLastName $lastName,
        Age $age,
        TelephoneNumber $tel,
        EmailAddress $email,
        string $password,
        UserAttribute $attribute,
        UserComment $comment,
        FamilyId $familyId
    ): UserModel
    {
        $user = new self(
            $id,
            $firstName,
            $lastName,
            $age,
            $tel,
            $email,
            $attribute,
            $password,
            $comment,
            $familyId
        );

        return $user;
    }

    /**
     * 完全な名前を返却します。
     * @return string
     */
    public function getFullName(): string
    {
        return $this->lastName->value(). $this->firstName->value();
    }

    /**
     * hasPassword
     * @return bool
     */
    public function hasPassword(): bool
    {
        return !!$this->password;
    }
}
