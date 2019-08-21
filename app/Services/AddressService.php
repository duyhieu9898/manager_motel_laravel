<?php
namespace App\Services;

use Illuminate\Support\Facades\DB;

class AddressService
{
    /**
     * get address by id
     *
     * @param integer $id
     * @return App/Address
     */
    public function getById(int $id)
    {
        $address= DB::table('addresses')
            ->select('street', 'wards.name as ward', 'districts.name as district', 'provinces.name as province')
            ->join('wards', 'addresses.ward_id', 'wards.id')
            ->join('districts', 'addresses.district_id', 'districts.id')
            ->join('provinces', 'addresses.province_id', 'provinces.id')
            ->where('addresses.id', $id)
            ->first();

        return $address;
    }

    /**
     * Update address by id
     *
     * @param integer  $id
     * @param array $dataAddress
     *
     * @return void
     */
    public function updateById(int $id, $dataAddress)
    {
        $address=DB::table('addresses')
            ->where('id', $id)
            ->update(
                [
                'addresses.street' => $dataAddress['street'],
                'addresses.ward_id' => $dataAddress['ward'],
                'addresses.district_id' => $dataAddress['district'],
                'addresses.province_id' => $dataAddress['province'],
                ]
            );

        return $address;
    }

    /**
     * store new address in resource
     *
     * @param array $dataAddress
     * @return integer
     */
    public function create($dataAddress)
    {
        $addressId=DB::table('addresses')
            ->insertGetId(
                [
                'street' => $dataAddress['street'],
                'ward_id' => $dataAddress['ward'],
                'district_id' => $dataAddress['district'],
                'province_id' => $dataAddress['province'],
                ]
            );

        return $addressId;
    }

    /**
     * Get list wards of the district by district id
     *
     * @param integer $districtId
     * @return array
     */
    public function getWardsByDistrictId($districtId)
    {
        return DB::table('wards')->where('district_id', $districtId)->get();
    }

    /**
     * Get list districts of the province by province id
     *
     * @param integer $provinceId
     * @return array
     */
    public function getDistrictsByProvinceId($provinceId)
    {
        return DB::table('districts')->where('province_id', $provinceId)->get();
    }

    /**
     * Get list Provinces
     * @return array
     */
    public function getProvinces()
    {
        return $listProvinces = DB::table('provinces')->get();
    }
}
