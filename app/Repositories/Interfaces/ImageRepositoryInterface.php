<?php 
namespace App\Repositories\Interfaces;
use Illuminate\Support\Collection;
use App\Models\User;
use packages\Domain\Entities\Image\ImageModel;
use packages\Domain\ValueObjects\Image\Image;
use packages\Domain\ValueObjects\User\UserId;

interface ImageRepositoryInterface
{

    /**
     * 特定のuserと紐ずく画像一覧を取得します。
     * @param UserId $id
     * @return ImageModel
     */
    public function fetchImage(UserId $id): ImageModel

    /**
     * 画像pathを保存します。
     * @param Image $image
     * @return void
     */
    public function store(Image $iamge): void;
}