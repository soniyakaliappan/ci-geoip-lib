**GeoIP Library for CodeIgniter - Version 1.0**

**Writted By Miguel A. Carrascosa (macrvk @ gmail.com)**


# English #
This library use the GeoLite Country (binary format) database from the ip address returned country\_name, country\_code, region, city, latitude, longitude, postal\_code, metro\_code (USA) and area\_code.

The database is from a company called Maxmind specializes in professional GeoIP solutions.
They also provide some free databases and free code.

You should then be able to use the following code in your page.


# Español #
Esta librería usa la base de datos Geolite Country (formato binario)
desde la dirección ip devuelve el país, código de país, provincia, ciudad,
latitud, longitud, código postal, código metropolitano (USA), y código de area.

La base de datos pertenece a la empresa Maxmind especializada en soluciones Geoip profesionales.

Ellos también proveen bases de datos gratuitas y código gratuito.

Puedes probar su funcionamiento usando el siguiente código en tu página:

```
<?php    
      $this->load->library('geoip_lib');
     
      $this->geoip_lib->InfoIP("24.24.24.24"); //For the "XXX.XXX.XXX.XXX" ip address        
      $this->geoip_lib->InfoIP(); //For the current ip address
     
      $array_all_data = $this->geoip_lib->result_array();
      $city           = $this->geoip_lib->result_city();          // Return Syracuse
      $area_code      = $this->geoip_lib->result_area_code();     // Return 315
      $country_code   = $this->geoip_lib->result_country_code();  // Return US
      $country_code3  = $this->geoip_lib->result_country_code3(); // Return USA 
      $country_name   = $this->geoip_lib->result_country_name();  // Return United States
      $metro_code     = $this->geoip_lib->result_metro_code();    // Return 555
      $postal_code    = $this->geoip_lib->result_postal_code();   // Return
      $latitude       = $this->geoip_lib->result_latitude();      // Return 43.0514
      $longitude      = $this->geoip_lib->result_longitude();     // Return -76.1495 
      $region         = $this->geoip_lib->result_region();        // Return NY
      $region_name    = $this->geoip_lib->result_region_name();   // Return New York
```

También puedes usar la función personalizada, para devolver la cadena formateada.

Ejemplo de variables (Custom vars):
  * %IP -> Ip Address
  * %CO -> Country\_code
  * %C3 -> Country\_code3
  * %CN -> Country\_name
  * %RE -> Region
  * %RN -> Region name
  * %CT -> City
  * %LA -> Latitude
  * %LO -> Longitude
  * %PC -> Postal code
  * %MC -> Metro code
  * %AC -> Area code.


```
<?php
$custon = $this->geoip_lib->result_custom("%CT , %RN (%C3)"); // Return  Madrid , Madrid (ESP)
```