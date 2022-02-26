<?php

namespace packages\Domain\User\Entities;

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
    private function __construct(){}

    /**
     * form空の入力値をfactory
     *
     * @param UserFirstName $firstName
     * @param UserLastName $lastName
     * @param Age $age
     * @param TelephoneNumber $tel
     * @param EmailAddress $email
     * @param string $password
     * @param UserAttribute $attribute
     * @param UserComment $comment
     * @return self
     */
    public static function formInit
    (
        UserFirstName $firstName,
        UserLastName $lastName,
        Age $age,
        TelephoneNumber $tel,
        EmailAddress $email,
        string $password,
        UserAttribute $attribute,
        UserComment $comment,
        FamilyId $familyId
    ): self
    {
        $user = new self();

        $user->firstName = $firstName;
        $user->lastName = $lastName;
        $user->age = $age;
        $user->tel = $tel;
        $user->email = $email;
        $user->password = $password;
        $user->attribute = $attribute;
        $user->comment = $comment;
        $user->familyId = $familyId;

        return $user;
    }

    /**
     * ファクトリーメソッド
     * ビジネスロジックはどうするの?
     * 基本的にrepositoryで取得した値に対して、Entityで形成して、インスタンとしてserviceに返している
     * 
     */
    public static function recreate
    (
        UserId $userId,
        UserFirstName $firstName,
        UserLastName $lastName,
        Age $age,
        TelephoneNumber $tel,
        EmailAddress $email,
        string $password,
        UserAttribute $attribute,
        UserComment $comment,
        FamilyId $familyId = null,
    ): UserModel
    {
        $user = new UserModel();

        $user->userId = $userId;
        $user->firstName = $firstName;
        $user->lastName = $lastName;
        $user->age = $age;
        $user->tel = $tel;
        $user->email = $email;
        $user->password = $password; //初期値的な意味合い？ つかまわし可能なobjectにしたい？？
        $user->attribute = $attribute;
        $user->comment = $comment;
        $user->familyId = $familyId;

        return $user;
    }

    /**
     * repositoryからの再構成用メソッド
     *
     * @param string $userId
     * @param string $firstName
     * @param string $lastName
     * @param integer $age
     * @param string $tel
     * @param string $email
     * @param integer $attribute
     * @return UserModel
     */
    public function reconstruct
    (
        string $userId,
        string $firstName,
        string $lastName,
        int $age,
        string $tel,
        string $email,
        string $password = null,
        int $attribute,
        string $comment,
        string $familyId
    ): UserModel
    {
        $user = self::recreate(
            new UserId($userId), 
            new UserFirstName($firstName), 
            new UserLastName($lastName), 
            new Age($age), 
            new TelephoneNumber($tel),
            new EmailAddress($email),
            $password, 
            new UserAttribute($attribute),
            new UserComment($comment),
            new FamilyId($familyId)
        );
        return $user;
    }

    /** 
     * userIdを返却します
     *  @return string
    */
    public function getUserId(): string
    {
        return $this->userId->getId();
    }

    /**
     * 名前を返却します。
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->firstName->getValue();
    }

    /**
     * 苗字を返却します。
     * @return string
     */
    public function getLastName(): string
    {
        return $this->lastName->getValue();
    }

    /**
     * 完全な名前を返却します。
     * @return string
     */
    public function getFullName(): string
    {
        return $this->lastName->getValue(). $this->firstName->getValue();
    }

    /**
     * 年齢を返却します。
     * @return int
     */
    public function getAge(): int
    {
        return $this->age->getValue();
    }

    /**
     * 名前を返却します。
     * @return string
     */
    public function getTel(): string
    {
        return $this->tel->getValue();
    }

    /**
     * eailを返却します。
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email->getValue();
    }

    /**
     * userステータスを返却します
     * @return string
     */
    public function getAttribute(): string
    {
        return $this->attribute->getValue();
    }

    /**
     * userの個人説明文を返却します
     * @return string
     */
    public function getComment(): string
    {
        return $this->comment->getValue();
    }

    /**
     * getter of password
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * getter of FamilyId
     * 
     * @return string
     */
    public function getFamilyId(): string
    {
        if(!$this->familyId->getId()) return $this->familyId->createId();

        return $this->familyId->getId();
    }


    /**  ミューテーターを記述していく */
    /**
     * attributeの値から、user属性を返却します
     * @param int $attribute
     * @return string
     */
    public function makeAttribute(): string
    {
        switch ($this->attribute){
            case 0:
                return '父';
            case 1:
                return '母';
            case 2:
                return '子';
        }
    }

}