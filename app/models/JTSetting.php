<?php
class JTSetting extends JT {

    protected $collection = 'tb_settings';

    public static function getAllCountry()
    {
        $arrCountries = JTCountry::select('name', 'value')
                                ->where('deleted', false)
                                ->orderBy('name', 'asc')
                                ->remember(1800)
                                ->get();
        $arrReturn = [];
        if( $arrCountries) {
            foreach($arrCountries as $country){
                $arrReturn[$country['value']] = $country['name'];
            }
        }
        return $arrReturn;
    }

    public static function getAllProvinceByCountry($countryID = 'CA')
    {
        $arrProvinces = JTProvince::select('name', 'key')
                                ->where('deleted', false)
                                ->where('country_id', $countryID)
                                ->orderBy('name', 'asc')
                                ->remember(1800)
                                ->get();
        $arrReturn = [];
        if( $arrProvinces ) {
            foreach($arrProvinces as $province){
                $arrReturn[$province['key']] = $province['name'];
            }
        }
        return $arrReturn;
    }

    public static function getDeliveryMethod()
    {
        $arrReturn = [];
        $arrMethods = self::where('setting_value', 'salesorder_delivery_method')
                                ->remember(1800)
                                ->pluck('option');
        if( !empty($arrMethods) ) {
            usort($arrMethods, function($a, $b){
                return strcmp($a['value'], $b['value']);
            });
            foreach($arrMethods as $method) {
                if( isset($method['deleted']) && $method['deleted'] ) continue;
                $arrReturn[$method['value']] = $method['name'];
            }
        }
        return $arrReturn;
    }
}
