<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AddressController extends Controller
{
    public function getWardsByDistrict($idDistrict)
    {
        $listWards = DB::table('wards')->where('district_id',$idDistrict)->get();
        if($listWards){
            return response()->json($listWards, 200);
        }
        return response('cannot get list wads',400);
    }

    public function getDistrictsByProvince($idProvince)
    {
        $listDistricts = DB::table('districts')->where('province_id',$idProvince)->get();
        if($listDistricts){
            return response()->json($listDistricts, 200);
        }
        return response('cannot get list districts',400);
    }

    public function getProvinces()
    {
        $listProvinces = DB::table('provinces')->get();
        return response()->json($listProvinces, 200);
    }

    public function getAddressByRoom($roomId)
    {
        $address= DB::table('rooms')
                ->select('street','wards.name as ward','districts.name as district','provinces.name as province')
                ->join('addresses', 'address_id', 'addresses.id')
                ->join('wards', 'addresses.ward_id', 'wards.id')
                ->join('districts', 'addresses.district_id', 'districts.id')
                ->join('provinces', 'addresses.province_id', 'provinces.id')
                ->where('rooms.id',$roomId)
                ->first();
        if($address){
            $stdAddress="$address->street $address->ward $address->district $address->province";
            return response()->json($stdAddress,200);
        }
        return response(400);

    }

    public function updateAddressByRoom(Request $request,$roomId)
    {
        if($request->has(['address.street', 'address.province.id', 'address.district.id', 'address.ward.id'])){
            $street=$request->address['street'];
            $wardId=$request->address['ward']['id'];
            $districtId=$request->address['district']['id'];
            $provinceId=$request->address['province']['id'];

            $address=DB::table('rooms')
            ->join('addresses', 'address_id', 'addresses.id')
            ->where('rooms.id',$roomId)
            ->update([
                'addresses.street' => $street,
                'addresses.ward_id' => $wardId,
                'addresses.district_id' => $districtId,
                'addresses.province_id' => $provinceId,
                ]);
            if($address){
                Log::debug($address);
                return response("success",200);
            }
        }
            Log::debug('updateAddressByRoom'.$request);
            return response(400);
    }
}
