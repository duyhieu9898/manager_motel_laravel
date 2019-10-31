<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use Illuminate\Support\Facades\DB;

class FooterComposer
{

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $arrData = DB::table('basic_information')->whereIn('name', [
            'footer_left_title',
            'footer_left_address',
            'footer_left_phone',
            'footer_left_title',
            'footer_left_address' ,
            'footer_left_phone',
            'footer_left_mail',
            'footer_mid_title',
            'footer_mid_address',
            'footer_mid_phone',
            'footer_mid_mail',
            'footer_right_title',
            'footer_right_facebook'
        ])->get()->toArray();
        for ($i=0; $i < count($arrData) ; $i++) {
            $arrData[$arrData[$i]->name] = $arrData[$i]->content;
            unset($arrData[$i]);
        }
        $view->with('dataFooter', $arrData);
    }
}
