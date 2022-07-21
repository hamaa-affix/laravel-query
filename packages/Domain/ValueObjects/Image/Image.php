<?php

namespace packages\Domain\ValueObjects\Image;

use Exception;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class Image
{
    /** @var UploadedFile */
    private UploadedFile $image;
    
    public function __construct(UploadedFile $image)
    {
        if($this->isExtensions($image)) throw new Exception('適切なファイル形式ではありません(jpg, png, GIFのみ可能)');
        if($this->maxImageSize($image)) throw new Exception('ファイルサイズが大きすぎます');
        $this->image = $this->exchangeFileName($image);
    }

    /**
     * 画像がjpeg, png, GIFであること
     * @param UploadedFile $image
     * @return bool
     */
    public function isExtensions(UploadedFile $image): bool
    {
        if($image->getClientOriginalExtension() === 'JPG') return true;
        if($image->getClientOriginalExtension() === 'png') return true;
        if($image->getClientOriginalExtension() === 'GIF') return true;
        
        return false;
    }

    /**
     * ファイルサイズがxxxxであること
     */
    public function maxImageSize(UploadedFile $image): bool
    {
        if($image->getMaxFilesize() < 10240) return true;
        
        return false;
    }

    /**
     * uploadされたファイル名を変更します。(加工)
     */
    public function exchangeFileName(UploadedFile $image)
    {
        $exc = $image->getClientOriginalExtension();
        $originName = $image->getClientOriginalName();
        $fileName = 'upload'. "/${originName}/". uniqid(). $exc; 

        return $fileName;
    }
 
}