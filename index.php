<?php

define('BASE_PATH', realpath(dirname(__FILE__)));
require BASE_PATH . '/vendor/autoload.php';

use Goutte\Client;

$site_url = 'https://www.gorentals.co.nz/rental-cars/';

$query_data = [
    'pickupdate'      => '04-04-2019',
    'pickuptime'      => '09:00',
    'pickuplocation'  => 'Auckland Domestic Airport',
    'dropoffdate'     => '14-05-2019',
    'dropofftime'     => '09:00',
    'dropofflocation' => 'Auckland Domestic Airport'
];

$site_url_with_params = $site_url . '?' . http_build_query($query_data);

$client = new Client();

$crawler = $client->request('GET', $site_url_with_params);

$json = $crawler->filterXpath('//input[@name="__GR_ListVehiclesForRentalNewLayout"]')->attr('value');

$cars = json_decode($json, true);

dump(count($cars));

foreach ($cars as $car) {
    dump($car['CarClassInfo']['Description'] . ' ' . $car['CarClassInfo']['International']);
}