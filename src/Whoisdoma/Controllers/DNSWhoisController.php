<?php

namespace Whoisdoma\Controllers;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use Whoisdoma\Models\WhoisServers;
use Whoisdoma\Models\ApiKey;

class DNSWhoisController extends BaseController 
{

    public $apikey;
    public $domain;
    public $errmsg;

   public function getUrlData()
   {

       $this->domain = Input::get('domain');
       $this->apikey = Input::get('api_key');

       //see if we have an api key
       if(!$this->apikey)
       {
            $this->errmsg = 'No api key provided';
           return false;
       } else {

           //check that api key is valid
           $check_apikey = ApiKey::where('api_key', '=', $this->apikey)->count();
           if ($check_apikey == 0)
           {
               $this->errmsg = 'The api key provided could not be found, or is not valid.';
               return false;
           }
           return true;
       }
   }
          
    public function LookupDNS() {

        if (!$this->getUrlData())
        {
            return Response::json(array(
                'error' => true,
                'result' => $this->errmsg
             ), 400);
        }
        else
        {
            $dn_ip = gethostbyname($this->domain);
        
            //return a response in json
            return Response::json(array(
                'error' => false,
                'domain' => $this->domain,
                'ip_address' => $dn_ip,
                'authns' => $this->getAuthNS($this->domain),
                'soa' => $this->getSOARecord($this->domain),
            ), 200);
        }
        
    }
    
    public function LookupAuthNS() {


        if (!$this->getUrlData())
        {
            return Response::json(array(
                'error' => true,
                'result' => $this->errmsg
            ), 400);
        }
        else
        {
            //get auth ns datat
            $authnsData = json_encode($this->getAuthNS($this->domain));

            $jsondata = json_decode($authnsData);

            $nsinfo = array();

            foreach ($jsondata as $nsdata)
            {
                $nsinfo[] = array(
                  'nameserver' => $nsdata->nameserver,
                  'ip' => $nsdata->ip,
                  'location' => $nsdata->location
                );
            }

            return Response::json(array(
                'error' => false,
                'domain' => $this->domain,
                'nsdata' => $nsinfo,
            ), 200);
        }
        
        
    }
    
     public function LookupSOARecord() {

         if (!$this->getUrlData())
         {
             return Response::json(array(
                 'error' => true,
                 'result' => $this->errmsg
             ), 400);

         }
         else
         {
        
            //get auth ns datat
            $soaData = $this->getSOARecord($this->domain);
                
            return Response::json(array(
                'error' => false,
                'domain' => $this->domain,
                'nameserver' => $soaData['nameserver'],
                'email' => $soaData['email'],
                'serial' => $soaData['serial'],
                'refresh' => $soaData['refresh'],
                'retry' => $soaData['retry'],
                'expiry' => $soaData['expiry'],
                'minimum' => $soaData['minimum']
            ),200);

         }

    }
    
     public function LookupAllDNS() {

         if (!$this->getUrlData())
         {
             return Response::json(array(
                 'error' => true,
                 'result' => $this->errmsg
             ), 400);
         }
         else
         {
        
            //get all dns records
            $dnsData = $this->getallRecords($this->domain);
              
            return Response::json(array(
                'error' => false,
                'domain' => $this->domain,
                'records' => $dnsData,
            ), 200);

         }
        
    }
    
    function getAuthNS($domain) {
        
        //get auth ns datat
        $authnsData = dns_get_record($domain, DNS_NS);

        $authns = array();

        $jsondata = json_encode($authnsData);

        $nsjson = json_decode($jsondata);

        //put the results into a nice array
        foreach($nsjson as $nsdata)
        {
            $authns[] = array(
                'nameserver' => $nsdata->target,
                'ip' => $this->getnsIP($nsdata->target),
                'location' => $this->getipLocation($this->getnsIP($nsdata->target))
            );
        }

        return $authns;


    }
    
    function getnsIP($domain){
        
        //get the nameserver ip
        $ns_ip = gethostbyname($domain);
        
        return $ns_ip;
    }
    
    function getipLocation($ip) { 
              
        $details = json_decode(file_get_contents("http://ipinfo.io/{$ip}"));;
  
        return $details->city;
        
    }
    
    function getSOARecord($domain) {
        
        //get the soa dns record
        $soaData = dns_get_record($domain, DNS_SOA);
        
        foreach($soaData as $soaInfo) {
            
            $soaRecord = array(
                'nameserver' => $soaInfo['mname'],
                'email' => $soaInfo['rname'],
                'serial' => $soaInfo['serial'],
                'refresh' => $soaInfo['refresh'],
                'retry' => $soaInfo['retry'],
                'expiry' => $soaInfo['expire'],
                'minimum' => $soaInfo['minimum-ttl']
            );
            
            return $soaRecord;
            
        }
        
    }
    
    
    function getallRecords($domain) {
        
        //assign a variable for the dns lookup
        $dnsData = dns_get_record($domain, DNS_ALL);
          
        //return the dns results
        return $dnsData;
       
    }
    
}
