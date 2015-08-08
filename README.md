# Convert local MySQL table to geojson result

The script can be used with any MySQL database with appropriate config file.

# Usage

The script returns all data in database in properties except for coordinates. For coordinates, change 'lat' and 'lng' to column names of coordinates in database if not already named 'lat' and 'lng' (e.g. 'latitude' and 'longitude'). 

If you want to return only select variables from database in geojson properties, then change:

'properties' => $properties

to

'properties' => array(
                    'id' => $value['id'], 
                    'source' => $value['source'], etc...,),


# Local geojson.json files

Uncomment write function at bottom of screen to store json files locally.