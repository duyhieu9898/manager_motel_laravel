<?php
namespace App\Repositories\Image;

use App\Repositories\BaseRepository;
use App\Image;

class ImageRepository extends BaseRepository implements ImageRepositoryInterface
{
    /**
     * @var Image
     */
    protected $model;

    /**
     * ImageRepository constructor.
     *
     * @param Image $model
     */
    public function __construct(Image $model)
    {
        parent::__construct($model);
    }

    public function storeImage(array $dataImage)
    {
        $sessionImage = new Image;
        $sessionImage->original_name = $dataImage['originalName'];
        $sessionImage->slug          = $dataImage['allowed_filename'];
        $sessionImage->file_name     = '/'.$dataImage['path'].$dataImage['filenameExt'];
        $sessionImage->save();

        if ($sessionImage->save()) {
            return $sessionImage->id;
        }
        return false;
    }

    public function deleteById(int $imageId)
    {
        $image = $this->model::find($imageId);
        if ($image->delete()) {
            return $image->file_name;
        }
        return false;
    }

    public function getListImagesByRoomId(int $roomId)
    {
        return $this->model::where('Room_id', $roomId)->get();
    }

    public function setImagesToRoom(array $arrImageId, int $roomId)
    {
        foreach ($arrImageId as $id) {
            $image = $this->model::findOrFail($id);
            $image->room_id=$roomId;
            $image->save();
        }
        return true;
    }

    public function setImageToRoom(int $imageId, int $roomId)
    {
        $image = $this->model::findOrFail($imageId);
        $image->room_id = $roomId;
        return $image->save();
    }
}
