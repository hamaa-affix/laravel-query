<?php

namespace packages\Domain\Entities\User;

use Attribute;
use Illuminate\Support\Facades\Hash;
use packages\Domain\ValueObjects\EmailAddress;
use packages\Domain\ValueObjects\TelephoneNumber;
use packages\Domain\ValueObjects\User\Age;
use packages\Domain\ValueObjects\User\UserAttribute;
use packages\Domain\ValueObjects\User\UserFirstName;
use packages\Domain\ValueObjects\User\UserId;
use packages\Domain\ValueObjects\User\UserLasttName;

class UserModel
{  
    /** @var int $userId */
    private int $userId;

    /** @var string $firstName */
    private string $firstName;

    /** @var string $lastName */
    private string $lastName;

    /** @var string $fullName */
    private string $fullName;

    /** @var int $age */
    private int $age;

    /** @var string $tel*/
    private string $tel;

    /** @var string $email */
    private string $email;

    /** @var string $password */
    private string $password;

    /** @var int $attribute */
    private int $attribute;

    /**
     * factory methodを使用する為にprivateにしておく
     */
    private function __construct(){}
    /**
     * ファクトリーメソッド
     * ビジネスロジックはどうするの?
     * 基本的にrepositoryで取得した値に対して、Entityで形成して、インスタンとしてserviceに返している
     * 
     */
    public static function create
    (
        UserId $userId,
        UserFirstName $firstName,
        UserLasttName $lastName,
        Age $age,
        TelephoneNumber $tel,
        EmailAddress $email,
        string $password,
        UserAttribute $attribute
    ): UserModel
    {
        $user = new UserModel();

        $user->userId = $userId;
        $user->firstName = $firstName;
        $user->lastName = $lastName;
        $user->age = $age;
        $user->tel = $tel;
        $user->email = $email;
        $user->password = $password ?? null; //初期値的な意味合い？ つかまわし可能なobjectにしたい？？
        $user->attribute = $attribute;

        return $user;
    }

    /**
     * repositoryからの再構成用メソッド
     *
     * @param integer $userId
     * @param string $firstName
     * @param string $lastName
     * @param integer $age
     * @param string $tel
     * @param string $email
     * @param integer $attribute
     * @return void
     */
    public function reconstruct
    (
        int $userId,
        string $firstName,
        string $lastName,
        int $age,
        string $tel,
        string $email,
        string $password = null,
        int $attribute
    ): UserModel
    {
        $user = self::create(
            UserId::reconstruct($userId), 
            UserFirstName::reconstruct($firstName), 
            UserLasttName::reconstruct($lastName), 
            Age::reconstruct($age), 
            TelephoneNumber::reconstruct($tel),
            EmailAddress::reconstruct($email),
            $password, 
            UserAttribute::reconstruct($attribute)
        );

        $user->fullName = $this->getFullName();

        return $user;
    }

    /** 
     * userIdを返却します
     *  @return int
    */
    public function getUserId(): int
    {
        return $this->userId;
    }

    /**
     * 名前を返却します。
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * 苗字を返却します。
     * @return string
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * 完全な名前を返却します。
     * @return string
     */
    public function getFullName(): string
    {
        return $this->lastName. $this->firstName;
    }

    /**
     * 年齢を返却します。
     * @return int
     */
    public function getAge(): int
    {
        return $this->age;
    }

    /**
     * 名前を返却します。
     * @return string
     */
    public function getTel(): string
    {
        return $this->tel;
    }

    /**
     * eailを返却します。
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * userステータスを返却します
     * @string
     */
    public function getAttribute(): string
    {
        return $this->attribute;
    }
}