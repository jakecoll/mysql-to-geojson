<?php
include_once(YOUR_PHPMYADMIN_CONFIG);

$dsn = 'mysql:host=localhost;dbname=YOUR_DB_NAME';

//$user & $password should come from config file
$conn = new PDO($dsn,$user,$password);
if (!$conn) {
	echo 'no connection\n';
	exit;
}
$sql = 'SELECT * FROM table_name ORDER BY id LIMIT 0,1000';

$rs = $conn->query($sql);
if (!$rs) {
    echo 'An SQL error occured.\n';
    exit;
}

$geojson = array (
	'type'	=> 'FeatureCollection',
	'features'	=> array()
);

while ($row = $rs->fetch(PDO::FETCH_ASSOC)) {
	$properties = $row;
	unset($properties['lat']);
	unset($properties['lng']);
	$feature = array(
		'type'	=> 'Feature',
		'geometry' => array(
			'type' => 'Point',
			'coordinates' => array(
					$row['lng'],
					$row['lat']
					)
			),
		'properties' => $properties
	);
	array_push($geojson['features'], $feature);
}

header('Content-type: application/json');
echo json_encode($geojson, JSON_PRETTY_PRINT);

//for local json files use code below

/*$fp = fopen('data.json', 'w');
fwrite($fp, geoJson($json));
fclose($fp);*/

$conn = NULL;

?>