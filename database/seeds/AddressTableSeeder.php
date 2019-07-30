<?php

use App\Address;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AddressTableSeeder extends Seeder
{
    private $listProvinceId;

    public function __construct()
    {
        $this->listProvinceId = DB::table('provinces')->select('id')->get()->toArray();
    }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 300; $i++) {
            $provinceId = $this->randProvinceId();
            $districtId = $this->randDistrictIdByProvinceId($provinceId);
            $wardId     = $this->randWardIdByDistrictId($districtId);
            Address::create([
                'street'      => "{$i} Quang trung",
                'ward_id'     =>  $wardId,
                'district_id' =>  $districtId,
                'province_id' =>  $provinceId,
            ]);
        }
    }
    public function randProvinceId()
    {
        $key = array_rand($this->listProvinceId);
        return $this->listProvinceId[$key]->id;
    }
    public function randDistrictIdByProvinceId($provinceId)
    {
        $listDistricts = DB::table('districts')->select('id')->where('province_id', $provinceId)->get()->toArray();
        $key = array_rand($listDistricts);
        return $listDistricts[$key]->id;
    }
    public function randWardIdByDistrictId($districtId)
    {
        $listWards = DB::table('wards')->select('id')->where('district_id', $districtId)->get()->toArray();
        $key = array_rand($listWards);
        return $listWards[$key]->id;
    }
}
