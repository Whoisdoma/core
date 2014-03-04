<?php

namespace Whoisdoma\Controllers;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use Whoisdoma\Models\WhoisServers;
use Whoisdoma\Models\ApiKey;

class DomainWhoisController extends BaseController 
{    
    
    public function LookupDomain() {
		
        //get domain from url
        $domain = Input::get('domain');
        $apikey = Input::get('api_key');
        
        //see if we have an api key
        if (!$apikey)
        {
            //no api key provided
            return Response::json(array(
                    'error' => true,
                    'result' => 'No api key provided'
		), 400);
        } else {
            
            //check that api key is valid
            $check_apikey = ApiKey::where('api_key', '=', $apikey)->count();
            if($check_apikey == 0) {
                
                //api key provided is not valid
                return Response::json(array(
                    'error' => true,
                    'result' => 'The api key provided could not be found, or is not valid.'
		), 400);
                
            }
            
        }
		
        //split domain into parts
        $domain_parts = explode(".", $domain);
	$tld = strtolower(array_pop($domain_parts));
        
        //check for whois server in the database
        $checktld = WhoisServers::where('tld', '=', $tld)->count();
	if($checktld == 0) {
            
            //no server was found for the tld
            return Response::json(array(
                    'error' => true,
                    'result' => 'No appropiate Whois server found for $domain domain!'
		), 400);
			
	}
        
        //whois server for the requested tld was found, get the server
	$whoisserver = WhoisServers::where('tld', $tld)->pluck('server');
        
        //perform the whois query
	$result = $this->QueryWhoisServer($whoisserver, $domain);
        
	if(!$result) 
	{
            //no response recieved from the whois server
            return Response::json(array(
                    'error' => true,
                    'domain' => $domain,
                    'whois_server' => $whoisserver,
                    'result' => 'No results retrieved from $whoisserver for $domain domain!'
		), 400);
			
	} else {
            
            while(strpos($result, "Whois Server:") !== FALSE)
            {
                preg_match("/Whois Server: (.*)/", $result, $matches);
		$secondary = $matches[1];
				
		if($secondary) 
		{
                    $result = $this->QueryWhoisServer($secondary, $domain);
                    $whoisserver = $secondary;
		}
            }
	}
        
        //whois lookup was successful, return the results
	return Response::json(array(
            'error' => false,
            'domain' => $domain,
            'whois_server' => $whoisserver,
            'result' => $result
	), 200);
		
	}
	
	function QueryWhoisServer($whoisserver, $domain) {
	$port = 43;
	$timeout = 10;
	$fp = @fsockopen($whoisserver, $port, $errno, $errstr, $timeout) or die("Socket Error " . $errno . " - " . $errstr);
	//if($whoisserver == "whois.verisign-grs.com") $domain = "=".$domain; // whois.verisign-grs.com requires the equals sign ("=") or it returns any result containing the searched string.
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
	return $res;
	}
}
