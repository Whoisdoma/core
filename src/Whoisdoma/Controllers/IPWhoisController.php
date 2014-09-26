<?php

namespace Whoisdoma\Controllers;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use Whoisdoma\Models\WhoisServers;
use Whoisdoma\Models\ApiKey;
use Illuminate\Support\Facades\Request;

class IPWhoisController extends BaseController
{

    public $apikey;
    public $domain;
    public $ip_address;
    public $errmsg;

   public function getUrlData()
   {

       //$this->domain = Input::get('domain');
       $this->apikey = Input::get('api_key');
       $this->ip_address = Input::get('ip');

       //see if we have an api key
       if(!$this->apikey)
       {
            //no api key was provided
            $this->errmsg = 'No api key provided';
            return false;

       } else {

           //check that api key is valid
           $check_apikey = ApiKey::where('api_key', '=', $this->apikey)->count();
           if ($check_apikey == 0)
           {
               //the api key provided was not valid
               $this->errmsg = 'The api key provided could not be found, or is not valid.';
               return false;
           }

           //the api key provided was valid
           return true;
       }
   }
          
    public function GetUserIP() {

        if (!$this->getUrlData())
        {
            return Response::json(array(
                'success' => false,
                'result' => $this->errmsg
             ), 400);
        }
        else
        {
            //return a response in json
            return Response::json(array(
                'success' => true,
                'user_ip' => Request::server('REMOTE_ADDR')
            ), 200);
        }
        
    }

    public function LookupIP()
    {
        if (!$this->getUrlData())
        {
            return Response::json(array(
                'success' => false,
                'result' => $this->errmsg
            ), 400);
        }
        else
        {
            if(!$this->ip_address)
            {
                return Response::json(array(
                    'success' => false,
                    'result' => 'No IP Address was provided'
                ), 400);
            }
            else
            {
                //we have our url data, and an ip address, make sure the ip address is valid
                if (!$this->ValidateIP())
                {
                    //the ip is not valid
                    return Response::json(array(
                        'success' => false,
                        'result' => $this->errmsg
                    ), 400);
                }
                else
                {
                    //ip address is valid, do ip whois
                    return Response::json(array(
                        'success' => true,
                        'result' => $this->DoIPWhois()
                    ), 200);
                }

            }
        }
    }

    public function DoIPWhois()
    {
        $whoisservers = array(
            "whois.lacnic.net",
            "whois.apnic.net",
            "whois.arin.net",
            "whois.ripe.net"
        );

        $results = array();

        foreach($whoisservers as $whoisserver) {

            $result = $this->QueryWhoisServer($whoisserver, $this->ip_address);

            if($result && !in_array($result, $results)) {
                $results[$whoisserver] = $result;
            }

        }

        $res = "";

        foreach($results as $whoisserver=>$result) {
            $res .= "Lookup results for $this->ip_address \n\n$result";
        }

        return $res;
    }

    public function ValidateIP() {

        $ipnums = explode(".", $this->ip_address);

        if(count($ipnums) != 4) {

            //ip address is not valid
            $this->errmsg = "The IP Address provided is not valid";
            return false;

        }

        foreach($ipnums as $ipnum) {

            if(!is_numeric($ipnum) || ($ipnum > 255)) {

                //ip address is not valid
                $this->errmsg = "The IP Address provided is not valid";
                return false;

            }
        }

        //ip address is valid
        return true;
    }

    public function QueryWhoisServer($whoisserver, $domain) {

        //set our port, and timeout
        $port = 43;
        $timeout = 10;

        //setup our fsock connection
        $fp = @fsockopen($whoisserver, $port, $errno, $errstr, $timeout) or die("Socket Error " . $errno . " - " . $errstr);
        if($whoisserver == "whois.verisign-grs.com") $domain = "=".$domain; // whois.verisign-grs.com requires the equals sign ("=") or it returns any result containing the searched string.
        fputs($fp, $domain . "\r\n");
        $out = "";
        while(!feof($fp)){
            $out .= fgets($fp);
        }
        fclose($fp);

        $res = "";
        if((strpos(strtolower($out), "error") === FALSE) && (strpos(strtolower($out), "not allocated") === FALSE)) {
            $rows = explode("\n", $out);
            foreach($rows as $row) {
                $row = trim($row);
                if(($row != '') && ($row{0} != '#') && ($row{0} != '%')) {
                    $res .= $row."\n";
                }
            }
        }

        //return our result
        return $res;
    }

    
}
