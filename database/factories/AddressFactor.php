<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Address;
use Illuminate\Support\Facades\DB;

$fakerVN = \Faker\Factory::create('vi_VN');
$listProvinceId = DB::table('provinces')->select('id')->get()->toArray();

function randProvinceId($listProvinceId)
{
    $key = array_rand($listProvinceId);
    return $listProvinceId[$key]->id;
}

function randDistrictIdByProvinceId($provinceId)
{
    $listDistricts = DB::table('districts')->select('id')->where('province_id', $provinceId)->get()->toArray();
    $key = array_rand($listDistricts);
    return $listDistricts[$key]->id;
}

function randWardIdByDistrictId($districtId)
{
    $listWards = DB::table('wards')->select('id')->where('district_id', $districtId)->get()->toArray();
    $key = array_rand($listWards);
    return $listWards[$key]->id;
}

$factory->define(Address::class, function () use ($listProvinceId, $fakerVN) {
    $provinceId = randProvinceId($listProvinceId);
    $districtId = randDistrictIdByProvinceId($provinceId);
    $wardId     = randWardIdByDistrictId($districtId);

    return [
        'street'      => $fakerVN->streetName,
        'ward_id'     =>  $wardId,
        'district_id' =>  $districtId,
        'province_id' =>  $provinceId,
    ];
});
