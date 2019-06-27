<?php
if (!function_exists('formatAddressToString')) {
    function formatAddressToString($addressCollection)
    {
        $arrAddressFilter = Arr::except($addressCollection->toArray(), ['id']);
        return implode(' ', $arrAddressFilter);
    }
}
