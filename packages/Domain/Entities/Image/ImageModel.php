<?php

namespace packages\Domain\Entities\Image;

use Illuminate\Support\Facades\Storage;
use packages\Domain\ValueObjects\Image\Image;

class ImageModel
{
    private Image $image;

    private function __construct()
    {}

    /**
     *factory method
     * @param Image $file
     * @return self
     */
    public static function create(Image $file): self
    {
        $image = new ImageModel();
        $image->image = $file;

        return $image;
    }

    /**
     * repositoryからの再構成用メソッド
     */
    public static function reconstruct(Image $value)
    {
        $image = self::create($value);

        return $image;
    }

    
    /**
     * 画像パスをs3へアップロードする
     */
    public function upload(): void
    {
        $image = new Image()
        Storage::putFileAs('/upload/', $this->$image);
    }

    /**
     *imageのvalue objectを返却するgetter
     * @return Image
     */
    public function getImage(): Image
    {
        return $this->image;
    }
}
