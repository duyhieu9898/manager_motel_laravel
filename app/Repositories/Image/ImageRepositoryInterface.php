<?php

namespace App\Repositories\Image;

use App\Repositories\RepositoryInterface;

interface ImageRepositoryInterface extends RepositoryInterface
{
    public function storeImage(array $dataImage);
    public function deleteById(int $imageId);
    public function getListImagesByRoomId(int $roomId);
    public function setImagesToRoom(array $arrImagesId, int $roomId);
}
