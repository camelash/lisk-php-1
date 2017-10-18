<?php
namespace LiskPhpBundle\Service;

class Lisk
{
    private $baseUrl;
    private $userAgent = "LiskPhpBundle using cURL";
    private $minVersion = ">=0.5.0";
    private $OS = "LiskPhpBundle";
    private $apiVersion = "1.0.0";
    private $networkHash = "ed14889723f24ecc54871d058d98ce91ff2f973192075c0155ba2b7b70ad2511"; // Mainnet
    //private $networkHash = "da3ed6a45429278bac2666961289ca17ad86595d33b31037615d4b8e8f158bba"; // Testnet

    const ACCOUNTS_ENDPOINT = "/api/accounts/";
    const BLOCKS_ENDPOINT = "/api/blocks/";
    const LOADER_ENDPOINT = "/api/loader/";
    const DELEGATE_ENDPOINT = "/api/delegates/";
    const SIGNATURE_ENDPOINT = "/api/signatures/";

    public function __construct($baseUrl)
    {
        $this->baseUrl = $baseUrl;
    }

    /*
     * Delegate endpoints
     */
    public function enableDelegate($secret, $secondSecret, $username)
    {
        return "NOT_YET_IMPLEMENTED";
    }

    public function getDelegates()
    {
        $url = $this->baseUrl . self::DELEGATE_ENDPOINT;
        return $this->execute("GET", $url, false, false, true);
    }

    public function getDelegateByUsername($username)
    {
        $url = $this->baseUrl . self::DELEGATE_ENDPOINT . "/get?username=" . $username;
        return $this->execute("GET", $url, false, false, true);
    }

    public function getDelegateByPublicKey($publicKey)
    {
        $url = $this->baseUrl . self::DELEGATE_ENDPOINT . "/get?publicKey=" . $publicKey;
        return $this->execute("GET", $url, false, false, true);
    }

    public function searchDelegates($username, $orderBy, $sortBy)
    {
        return "NOT_YET_IMPLEMENTED";
    }

    public function getDelegateCount()
    {
        $url = $this->baseUrl . self::DELEGATE_ENDPOINT . "/count";
        return $this->execute("GET", $url, false, false, true);
    }

    public function getDelegateVoters($publicKey)
    {
        $url = $this->baseUrl . self::DELEGATE_ENDPOINT . "/voters?publicKey=" . $publicKey;
        return $this->execute("GET", $url, false, false, true);
    }

    public function enableForging($secret)
    {
        $url = $this->baseUrl . self::DELEGATE_ENDPOINT . '/forging/enable';
        $postBody = "secret=" . $secret;
        return $this->execute("POST", $url, $postBody, false, true);
    }

    public function disableForging($secret)
    {
        $url = $this->baseUrl . self::DELEGATE_ENDPOINT . '/forging/disable';
        $postBody = "secret=" . $secret;
        return $this->execute("POST", $url, $postBody, false, true);
    }

    public function getForgedByPublicKey($publicKey)
    {
        $url = $this->baseUrl . self::DELEGATE_ENDPOINT . "/forging/getForgedByAccount?generatorPublicKey=" . $publicKey;
        return $this->execute("GET", $url, false, false, true);
    }

    public function getNextForgers($limit = 10)
    {
        if ($limit < 1 || $limit > 101) {
            return false;
        }

        $url = $this->baseUrl . self::DELEGATE_ENDPOINT . "/forging/getNextForgers?limit=" . $limit;
        return $this->execute("GET", $url, false, false, true);
    }

    /*
     * Account endpoints
     */
    public function openAccount($secret)
    {
        $url = $this->baseUrl . self::ACCOUNTS_ENDPOINT . '/open';
        $postBody = "secret=" . $secret;
        return $this->execute("POST", $url, $postBody, false, true);
    }

    public function getAccountBalance($address)
    {
        $url = $this->baseUrl . self::ACCOUNTS_ENDPOINT . '/getBalance?address=' . $address;
        return $this->execute("GET", $url, false, false, true);
    }

    public function getAccountPublicKey($address)
    {
        $url = $this->baseUrl . self::ACCOUNTS_ENDPOINT . '/getPublicKey?address=' . $address;
        return $this->execute("GET", $url, false, false, true);
    }

    public function generateAccountPublicKey($secret)
    {
        $url = $this->baseUrl . self::ACCOUNTS_ENDPOINT . '/generatePublicKey';
        $postBody = "secret=" . $secret;
        return $this->execute("POST", $url, $postBody, false, true);
    }

    public function getAccountInfo($address){
        $url = $this->baseUrl . self::ACCOUNTS_ENDPOINT . '?address=' . $address;
        return $this->execute("GET", $url, false, false, true);
    }

    public function getVotesByAddress($address){
        $url = $this->baseUrl . self::ACCOUNTS_ENDPOINT . '/delegates?address=' . $address;
        return $this->execute("GET",$url,true,false,true);
    }

    public function voteDelegates($votes){
        return "NOT_YET_IMPLEMENTED";
    }
    
    /*
     * Loader endpoints
     */
    public function getLoadingStatus(){
        $url = $this->baseUrl . self::LOADER_ENDPOINT . '/status';
        return $this->execute("GET",$url,true,false,true);
    }

    public function getSyncStatus(){
        $url = $this->baseUrl . self::LOADER_ENDPOINT . '/status/sync';
        return $this->execute("GET",$url,true,false,true);
    }

    public function getPing(){
        $url = $this->baseUrl . self::LOADER_ENDPOINT . '/status/ping';
        return $this->execute("GET",$url,true,false,true);
    }

    /*
     * Block endpoints
     */
    public function getBlocks(){
        $url = $this->baseUrl . self::BLOCKS_ENDPOINT;
        return $this->execute("GET",$url,false,false,true);
    }

    public function getBlockById($blockId){
        $url = $this->baseUrl . self::BLOCKS_ENDPOINT . "/get?id=" . $blockId;
        return $this->execute("GET",$url,false,false,true);
    }

    public function getBlockByHeight($blockHeight){
        $url = $this->baseUrl . self::BLOCKS_ENDPOINT . "?height=" . $blockHeight;
        return $this->execute("GET", $url, false, false, true);
    }

    /*
     * Signature endpoints
     */
    public function getSignatureFee(){
        $url = $this->baseUrl . self::SIGNATURE_ENDPOINT . '/fee';
        return $this->execute("GET", $url, false, false, true);
    }

    public function addSecondSignature(){
        return "NOT_YET_IMPLEMENTED";
    }

    // Function to execute the call to the Lisk node
    private function execute($method, $url, $body = false, $jsonBody=true, $jsonResponse=true, $timeout=3){
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERAGENT, $this->userAgent);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT ,$timeout);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);

        $headers =  array();
        if ($body) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
            if ($jsonBody) {
                $headers = array('Content-Type: application/json','Content-Length: ' . strlen($body));
            }
        }

        $port = parse_url($url)['port'];
        if (!$port) {
            if (parse_url($url)['scheme']=='https') {
                $port="443";
            } else {
                $port="80";
            }
        }
        array_push($headers, "minVersion: " . $this->minVersion);
        array_push($headers, "os: ". $this->OS);
        array_push($headers, "version: ". $this->apiVersion);
        array_push($headers, "port: ". $port);
        array_push($headers, "Accept-Language: en-GB");
        array_push($headers, "nethash: ". $this->networkHash);
        array_push($headers, "broadhash: ".$this->networkHash);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $result = curl_exec($ch);
        if ($jsonResponse) {
            $result = json_decode($result, true);
        }
        return $result;
    }
}