<?php

namespace App\Repositories\Image;

use App\Repositories\RepositoryInterface;

interface ImageRepositoryInterface extends RepositoryInterface
{
    public function storeByRoomId($form_data, $roomId);
    public function deleteById(int $imageId);
    public function createUniqueFilename($filename, $path);
    public function original($photo, $filename, $path);
    public function sanitize($string, $force_lowercase = true, $anal = false);
    public function getListImagesByRoom(int $roomId);
    public function firstOrCreateFolderStore();
    public function setImagesToRoom(array $arrImagesId, int $roomId);
}
