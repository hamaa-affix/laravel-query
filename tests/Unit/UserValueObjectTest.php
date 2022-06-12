<?php

namespace Tests\Unit;

use packages\Domain\User\ValueObjects\Age;
use packages\Domain\User\ValueObjects\EmailAddress;
use packages\Domain\User\ValueObjects\TelephoneNumber;
use packages\Domain\User\ValueObjects\UserComment;
use packages\Domain\User\ValueObjects\UserFirstName;
use packages\Domain\User\ValueObjects\UserLastName;
use PHPUnit\Framework\TestCase;

class UserValueObjectTest extends TestCase
{
    public function test苗字が正しい値であること()
    {
        $lastName = new UserLastName('田中');

        $this->assertNotNull($lastName->value());
    }

    public function test名前が正しい値であること()
    {
        $firstName = new UserFirstName('幸助');

        $this->assertNotNull($firstName->value());
    }

    public function test年齢が正しい値であること()
    {
        $age = new Age(21);

        $this->assertNotNull($age->value());
    }

    public function testUser紹介文が正しい値であること()
    {
        $comment = new UserComment('よろしくお願いします');

        $this->assertNotNull($comment->value());
    }

    public function testメールアドレスが正しい値であること()
    {
        $email = new EmailAddress('hoge@hoge.com');

        $this->assertNotNull($email->value());
    }

    public function test電話番号が正しい値であること()
    {
        $tel = new TelephoneNumber('09011223311');

        $this->assertNotNull($tel->value());
    }
}
