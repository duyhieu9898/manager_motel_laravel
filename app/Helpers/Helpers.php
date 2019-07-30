<?php
if (!function_exists('formatAddressToString')) {
	function formatAddressToString($addressCollection) {
		$arrAddressFilter = Arr::except($addressCollection->toArray(), ['id']);
		return implode(' ', $arrAddressFilter);
	}
}
if (!function_exists('formatMoney')) {
	function formatMoney($number, $unit) {
		return preg_replace('/(\d)(?=(\d{3})+(?!\d))/', '$1,', $number) . ' ' . $unit;
	}
}
