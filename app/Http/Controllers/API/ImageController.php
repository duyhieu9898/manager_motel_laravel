<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\ImageRequest;
use App\Repositories\Image\ImageRepositoryInterface;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;

class ImageController extends Controller
{
    private $imageRepository;

    public function __construct(ImageRepositoryInterface $imageRepository)
    {
        $this->imageRepository = $imageRepository;
    }

    /**
    * store image for room create
    *
    * @param  App\Http\Requests\ImageRequest  $request
    * @param  int  $roomId
    * @return \Illuminate\Http\Response
    */
    public function store(ImageRequest $request)
    {
        $photo = $request->file;
        $dataImage=$this->uploadImageToServer($photo);
        $imageId = $this->imageRepository->storeImage($dataImage);

        if (!$imageId) {
            return response()->json([
                'message' => 'Server error while store image to DB',
            ], 500);
        }

        return response()->json(['image_id' => $imageId], 201);
    }

    /**
     * Remove image
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $fullPathImage = $this->imageRepository->deleteById($id);

        if (!$fullPathImage) {
            return response()->json([
                'message' => 'Server error while destroy image'
            ], 500);
        }

        if (!File::exists(public_path().$fullPathImage)) {
            return response()->json([
                'message' => 'Server error while delete image to serve',
            ], 500);
        }

        File::delete(public_path().$fullPathImage);
        return response()->json(['message' => 'delete success'], 200);
    }

    /**
     * get list images by room id
     *
     * @param int $roomId
     * @return \Illuminate\Http\Response
     */
    public function getListImagesByRoomId(int $roomId)
    {
        $listImages = $this->imageRepository->getListImagesByRoomId($roomId);

        if (!$listImages) {
            return response()->json([
                'message' => 'Server error while get list image'
            ], 500);
        }

        return response()->json($listImages, 200);
    }

    /**
     * Save Image for room update
     *
     * @param ImageRequest $request
     * @param int $roomId
     * @return \Illuminate\Http\Response
     */
    public function saveImage(ImageRequest $request, int $roomId)
    {
        $photo = $request->file;
        $dataImage = $this->uploadImageToServer($photo);

        if (!$dataImage) {
            return response()->json([
                'message' => 'Server error while uploading image'
            ], 500);
        }

        $imageId = $this->imageRepository->storeImage($dataImage, $roomId);

        if (!$imageId) {
            return response()->json([
                'message' => 'Server error while storing image'
            ], 500);
        }

        $this->imageRepository->setImageToRoom($imageId, $roomId);
        return response()->json(['image_id' => $imageId], 201);
    }

    /**
     * up load image to server
     *
     * @param image $photo
     * @return array
     */
    private function uploadImageToServer($photo)
    {
        $path = $this->firstOrCreateFolderStore();
        $originalName = $photo->getClientOriginalName();
        $originalNameWithoutExt = substr($originalName, 0, strlen($originalName) - 4);
        $filename = $this->sanitize($originalNameWithoutExt);
        $allowed_filename = $this->createUniqueFilename($filename, $path);
        $filenameExt = $allowed_filename . ".jpg";
        $image = $this->original($photo, $filenameExt, $path);

        if ($image) {
            $dataImage=[
                'path' => $path,
                'allowed_filename'=> $allowed_filename,
                'originalName' => $originalName,
                'filenameExt' => $filenameExt,
            ];
            return $dataImage;
        }
        return false;
    }

    /**
     * create folder upload image
     *
     * @return string
     */
    private function firstOrCreateFolderStore()
    {
        $path = 'uploads/images/' . date('Y') . "/" . date('m') . "/";

        if (!file_exists($path) && !is_dir($path)) {
            File::makeDirectory($path, $mode = 0777, true, true);
        }

        return $path;
    }

    /**
     * create name image unique
     *
     * @param string $filename
     * @param string $path
     * @return string
     */
    private function createUniqueFilename($filename, $path)
    {
        $full_image_path =  $path . Config::get('images.full_size') . $filename . '.jpg';

        if (File::exists($full_image_path)) {
            // Generate token for image
            $imageToken = substr(sha1(mt_rand()), 0, 6);
            return $filename . '-' . $imageToken;
        }

        return $filename;
    }

    /**
     * Optimize Original Image
     *
     * @param Image $photo
     * @param string $filename
     * @param string $path
     * @return Image
     */
    private function original($photo, $filename, $path)
    {
        $manager = new ImageManager();
        $image = $manager->make($photo)->encode('jpg')->save($path . Config::get('images.full_size') . $filename);
        return $image;
    }

    private function sanitize($string, $force_lowercase = true, $anal = false)
    {
        $strip = array(
            "~", "`", "!", "@", "#", "$", "%", "^", "&", "*", "(", ")", "_", "=", "+", "[", "{", "]",
            "}", "\\", "|", ";", ":", "\"", "'", "&#8216;", "&#8217;", "&#8220;", "&#8221;", "&#8211;", "&#8212;",
            "â€”", "â€“", ",", "<", ".", ">", "/", "?"
        );
        $clean = trim(str_replace($strip, "", strip_tags($string)));
        $clean = preg_replace('/\s+/', "-", $clean);
        $clean = ($anal) ? preg_replace("/[^a-zA-Z0-9]/", "", $clean) : $clean;

        return ($force_lowercase) ? (function_exists('mb_strtolower')) ?
            mb_strtolower($clean, 'UTF-8') : strtolower($clean) : $clean;
    }
}
