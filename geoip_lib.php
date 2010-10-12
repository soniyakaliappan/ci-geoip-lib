<?php (defined('BASEPATH') OR defined('SYSPATH')) or die('No direct access allowed.');

    /*
     * GeoIP Library for CodeIgniter - Version 1.0
     * Writted By Miguel A. Carrascosa (macrvk_at_gmail[dot]com)
     *
     * This plugin use the GeoLite Country (binary format) database
     * from the ip address returned country_name, country_code, region, city, 
     * latitude, longitude, postal_code, metro_code and area_code.
     *
     * The database is from a company called Maxmind specializes in professional GeoIP solutions.
     * They also provide some free databases and free code. 
     * 
     */
     
    if (!defined('GEOIP_FILEDATA')) define('GEOIP_FILEDATA', dirname(__FILE__)."/geoip/GeoLiteCity.dat");

    global $GEOIP_REGION_NAME;
    include("geoip/geoipcity.inc");
    require_once 'geoip/geoipregionvars.php';
    
    class Geoip_lib{
        
        protected $CI;
        protected $_Ip;
        protected $_Data;
    	protected $_gi;
    	// Constructor
    	function __construct()
    	{
    		if (!isset($this->CI))
    		{
    			$this->CI =& get_instance();
    		}
    	}
        
       function __destruct() {
        
      		if (isset($this->_gi))
    		{
    			geoip_close($this->_gi);
    		}   
       }
        
        private function _Set_IP($ip=null){
            
            if($ip==null)
            {
                $ip = $this->CI->input->ip_address();
            }
            
            $this->_Ip = $ip;           
            return $this->CI->input->valid_ip($this->_Ip);    
        }
        
        public function InfoIP($ip=null){
            
            if (!$this->_Set_IP($ip))
            {
                $this->_Data = array();
                return false;
            }
            
            return $this->_Query();
                
        }
        
        private function _Query() {    
       
      		if (!isset($this->_gi))
    		{
    			$this->_gi = geoip_open(GEOIP_FILEDATA,GEOIP_STANDARD);
    		}

            $this->_Data = geoip_record_by_addr($this->_gi,$this->_Ip);
            
        }
        
    	function result_array()
    	{
            $dev = array(
                'ip'            => $this->result_ip(),
                'country_code'  => $this->result_country_code(),
                'country_code3' => $this->result_country_code3(),
                'country_name'  => $this->result_country_name(),
                'region'        => $this->result_region(),
                'region_name'   => $this->result_region_name(),
                'city'          => $this->result_city(),
                'latitude'      => $this->result_latitude(),    
                'longitude'     => $this->result_longitude(),
                'postal_code'   => $this->result_postal_code(),
                'metro_code'    => $this->result_metro_code(),    
                'area_code'     => $this->result_area_code(),           
            );
            
            return $dev;
    	}
        
        function result_debug(){
            print "<pre>";
            print_r($this->result_array());
            print "</pre>";
    		return true;

        }
        
        function result_region_name(){
            global $GEOIP_REGION_NAME;
            $code = $this->result_country_code();
            $region = $this->result_region();
            if(!empty($code)&&!empty($region))
            {
                if(isset($GEOIP_REGION_NAME[$code][$region]))
                    return $GEOIP_REGION_NAME[$code][$region];
            }
            return 'unknown';
        }

        function result_region(){
            return $this->_Data->region;
        }
        
        function result_city(){
            return $this->_Data->city;
        }

        function result_country_name(){
            return $this->_Data->country_name;
        }
        
        function result_country_code(){
            return $this->_Data->country_code;
        }
        
        function result_country_code3(){
            return $this->_Data->country_code3;
        }
        
        function result_latitude(){
            return $this->_Data->latitude;
        }
        
        function result_longitude(){
            return $this->_Data->longitude;
        }        

        function result_postal_code(){
            return $this->_Data->postal_code;
        }
        
        function result_metro_code(){
            return $this->_Data->metro_code;
        }
        
        function result_area_code(){
            return $this->_Data->area_code;
        }           

        function result_ip(){
            return $this->_Ip;
        }
 
    }


    
?>