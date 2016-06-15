<?php
session_start();
/*Get user ip address*/
$ip_address=$_SERVER['REMOTE_ADDR'];
$_SESSION['ip']=$ip_address;
//echo $ip_address;

/*Get user ip address details with geoplugin.net*/
$geopluginURL='http://www.geoplugin.net/php.gp?ip='.$ip_address;
$addrDetailsArr = unserialize(file_get_contents($geopluginURL)); 

/*Get City name */
$city = $addrDetailsArr['geoplugin_city']; 
/*Get Country name */
$country = $addrDetailsArr['geoplugin_countryName'];
/*Get City name by */
$region = $addrDetailsArr['geoplugin_region'];
/*Get Country Code */
$countryCode = $addrDetailsArr['geoplugin_countryCode'];
/*Get Currency Code */
$currencyCode = $addrDetailsArr['geoplugin_currencyCode'];
/*Get Currency Symbol */
$_SESSION['currencySymbol'] = $addrDetailsArr['geoplugin_currencySymbol'];
/*Get latitude */
$latitude = $addrDetailsArr['geoplugin_latitude'];
/*Get longitude */
$longitude = $addrDetailsArr['geoplugin_longitude'];


/*Comment out these line to see all the posible details*/
/*
echo '

<pre>';
print_r($addrDetailsArr);
echo '</pre>

';

Array
(
 [geoplugin_request] => 122.180.164.222
 [geoplugin_status] => 200
 [geoplugin_credit] => Some of the returned data includes GeoLite data created by MaxMind, available from http://www.maxmind.com.
 [geoplugin_city] => New Delhi
 [geoplugin_region] => Delhi
 [geoplugin_areaCode] => 0
 [geoplugin_dmaCode] => 0
 [geoplugin_countryCode] => IN
 [geoplugin_countryName] => India
 [geoplugin_continentCode] => AS
 [geoplugin_latitude] => 28.6
 [geoplugin_longitude] => 77.199997
 [geoplugin_regionCode] => 07
 [geoplugin_regionName] => Delhi
 [geoplugin_currencyCode] => INR
 [geoplugin_currencySymbol] => ₨
 [geoplugin_currencySymbol_UTF8] => â‚¨
 [geoplugin_currencyConverter] => 63.3715
)
*/

if(!$city){
 $city='Not Define';
}if(!$country){
 $country='Not Define';
}
/*echo '<strong>IP Address</strong>:- '.$ip_address.'';
echo '<strong>City</strong>:- '.$city.'';
echo '<strong>Country</strong>:- '.$country.'';
echo '<strong>Region</strong>:- '.$region.'';
echo '<strong>Country Code</strong>:- '.$countryCode.'';
echo '<strong>Currency Code</strong>:- '.$currencyCode.'';
echo '<strong>Currency Symbol</strong>:- '.$currencySymbol.'';
echo '<strong>Latitude</strong>:- '.$latitude.'';
echo '<strong>Latitude</strong>:- '.$longitude.'';*/
?>