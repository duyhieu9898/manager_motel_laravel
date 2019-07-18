<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class AddressController extends Controller
{
    public function create(Request $request)
    {
        if ($request->has(['street', 'province', 'district', 'ward' ])) {
            $addressId=DB::table('addresses')
                ->insertGetId(
                    [
                    'street' => $request->street,
                    'ward_id' => $request->ward,
                    'district_id' => $request->district,
                    'province_id' => $request->province,
                    ]
                );
            if ($addressId) {
                return response()->json([
                    'message' => 'create address success',
                    "address_id" => $addressId
                ], 200);
            }
        }
        return response()->json([
            'message'=> 'Server error while creating address ', 500
            ]);
    }

    /**
     * Get list wards of the district by district id
     *
     * @param integer $districtId
     * @return Response
     */
    public function getWardsByDistrict(int $districtId)
    {
        $listWards = DB::table('wards')->where('district_id', $districtId)->get();
        if ($listWards) {
            return response()->json($listWards, 200);
        }
        return response()->json([
            'message'=> 'Server error while get  list Ward ', 500
        ]);
    }
    /**
     * Get list districts of the province by province id
     *
     * @param integer $provinceId
     * @return Response
     */
    public function getDistrictsByProvince(int $provinceId)
    {
        $listDistricts = DB::table('districts')->where('province_id', $provinceId)->get();
        if ($listDistricts) {
            return response()->json($listDistricts, 200);
        }
        return response()->json([
            'message'=> 'Server error while get list Districts ', 500
        ]);
    }
    /**
     * Get list Provinces
     * @return Response
     */
    public function getProvinces()
    {
        $listProvinces = DB::table('provinces')->get();
        return response()->json($listProvinces, 200);
    }
    /**
     * Get address of the room by room id
     *
     * @param integer $roomId
     * @return Response
     */
    public function getAddressByRoom(int $roomId)
    {
        $address= DB::table('rooms')
                ->select('street', 'wards.name as ward', 'districts.name as district', 'provinces.name as province')
                ->join('addresses', 'address_id', 'addresses.id')
                ->join('wards', 'addresses.ward_id', 'wards.id')
                ->join('districts', 'addresses.district_id', 'districts.id')
                ->join('provinces', 'addresses.province_id', 'provinces.id')
                ->where('rooms.id', $roomId)
                ->first();
        if ($address) {
            $stdAddress ="$address->street - $address->ward, $address->district, $address->province";
            return response()->json($stdAddress, 200);
        }
        return response()->json([
            'message'=> 'Server error while get address ', 500
            ]);
    }
    /**
     * Update address of the room by room id
     *
     * @param Request $request
     * @param integer $roomId
     *
     * @return void
     */
    public function updateAddressByRoom(Request $request, int $roomId)
    {
        if ($request->has(['street', 'province', 'district', 'ward' ])) {
            $address=DB::table('rooms')
                ->join('addresses', 'address_id', 'addresses.id')
                ->where('rooms.id', $roomId)
                ->update(
                    [
                    'addresses.street' => $request->street,
                    'addresses.ward_id' => $request->ward,
                    'addresses.district_id' => $request->district,
                    'addresses.province_id' => $request->province,
                    ]
                );
            if ($address) {
                return response()->json([
                    'message'=> 'update address success', 200
                    ]);
            }
        }
        return response()->json([
            'message' => 'Server error while updating address',
        ], 500);
    }
}
