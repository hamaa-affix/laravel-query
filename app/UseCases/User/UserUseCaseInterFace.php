<?php

namespace App\UseCases\User;

interface UserUseCaseInterFace
{
    /**
     * Userデータを返却します。
     * @return array
     *
     */
    public function getUser(): array;

}
