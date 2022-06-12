<?php

namespace Tests\Unit;

use packages\Domain\User\Entities\UserModel as User;
use packages\Domain\User\ValueObjects\Age;
use packages\Domain\User\ValueObjects\EmailAddress;
use packages\Domain\User\ValueObjects\TelephoneNumber;
use packages\Domain\User\ValueObjects\UserAttribute;
use packages\Domain\User\ValueObjects\UserComment;
use packages\Domain\User\ValueObjects\UserFirstName;
use packages\Domain\User\ValueObjects\UserLastName;
use PHPUnit\Framework\TestCase;

class UserEntityTest extends TestCase
{
    public function test入力値からEntity生成できること()
    {
        $user = User::create(
            new UserFirstName('yuta'),
            new UserLastName('tanaka'),
            new Age(30),
            new TelephoneNumber('00011112222'),
            new EmailAddress('hoge@hoge.com'),
            'hogehoge',
            new UserAttribute(0),
            new UserComment('よろしくお願いします')
        );

        $this->assertNotEmpty(($user)->getFullName());
    }
}
