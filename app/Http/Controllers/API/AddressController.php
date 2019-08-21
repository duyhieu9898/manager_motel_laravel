<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\AddressService;

class AddressController extends Controller
{
    private $addressService;
    public function __construct(AddressService $addressService)
    {
        $this->addressService=$addressService;
    }
    /**
     * get address by id
     *
     * @param integer $id
     * @return void
     */
    public function getById(int $id)
    {
        $address= $this->addressService->getById($id);
        if ($address) {
            return response()->json(['address' => $address], 200);
        }
        return response()->json([
            'message'=> 'Server error while get address ',
        ], 500);
    }

    /**
     * Update address by id
     *
     * @param Request $request
     * @param integer $roomId
     *
     * @return void
     */
    public function updateById(Request $request, int $id)
    {
        if (!$request->has(['street', 'province', 'district', 'ward' ])) {
            return response()->json(['message' => 'validate error',], 500);
        }
        $dataAddress = [
                "street" => $request->street,
                "ward" => $request->ward,
                "district" => $request->district,
                "province" => $request->province
            ];


        if ($this->addressService->updateById($id, $dataAddress)) {
            return response()->json(['message'=> 'update address success', 200]);
        }
        return response()->json(['message' => 'Server error while updating address',], 500);
    }

    /**
     * store new address in resource
     *
     * @param Request $request
     * @return void
     */
    public function create(Request $request)
    {
        if (!$request->has(['street', 'province', 'district', 'ward' ])) {
            return response()->json(['message' => 'validate error',], 500);
        }
        $dataAddress = [
                "street" => $request->street,
                "ward" => $request->ward,
                "district" => $request->district,
                "province" => $request->province
            ];
        $addressId = $this->addressService->create($dataAddress);

        if (!$addressId) {
            return response()->json(['message'=> 'Server error while creating address ', 500]);
        }
        return response()->json(["address_id" => $addressId], 201);
    }

    /**
     * Get list wards of the district by district id
     *
     * @param integer $districtId
     * @return Response
     */
    public function getWardsByDistrictId($districtId)
    {
        $listWards = $this->addressService->getWardsByDistrictId($districtId);
        if (!$listWards) {
            return response()->json([
                'message'=> 'Server error while get list Ward ', 500
            ]);
        }
        return response()->json($listWards, 200);
    }

    /**
     * Get list districts of the province by province id
     *
     * @param integer $provinceId
     * @return Response
     */
    public function getDistrictsByProvinceId($provinceId)
    {
        $listDistricts = $this->addressService->getDistrictsByProvinceId($provinceId);
        if (!$listDistricts) {
            return response()->json([
                'message'=> 'Server error while get list Districts ', 500
            ]);
        }
        return response()->json($listDistricts, 200);
    }

    /**
     * Get list Provinces
     * @return Response
     */
    public function getProvinces()
    {
        $listProvinces =  $this->addressService->getProvinces();
        if (!$listProvinces) {
            return response()->json([
                'message'=> 'Server error while get list Districts ', 500
            ]);
        }

        return response()->json($listProvinces, 200);
    }
}
