<?php
 
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Name: Twilio
*
* Author: Ben Edmunds
* ben.edmunds@gmail.com
* @benedmunds
*
* Location:
*
* Created: 03.29.2011
*
* Description: Modified Twilio API classes to work as a CodeIgniter library.
* Added additional helper methods.
* Original code and copyright are below.
*
*
*/
class Twilio
{
protected $_ci;
protected $_twilio;
protected $mode;
protected $account_sid;
protected $auth_token;
protected $api_version;
protected $number;
function __construct()
{
//initialize the CI super-object
$this->_ci =& get_instance();
 
//load config
$this->_ci->load->config('twilio', TRUE);
 
//get settings from config
$this->mode = $this->_ci->config->item('mode', 'twilio');
$this->account_sid = $this->_ci->config->item('account_sid', 'twilio');
$this->auth_token = $this->_ci->config->item('auth_token', 'twilio');
$this->api_version = $this->_ci->config->item('api_version', 'twilio');
$this->number = $this->_ci->config->item('number', 'twilio');
//initialize the client
$this->_twilio = new TwilioRestClient($this->account_sid, $this->auth_token);
}
 
/**
* __call
*
* @desc Interface with rest client
*
*/
public function __call($method, $arguments)
{
if (!method_exists( $this->_twilio, $method) )
{
throw new Exception('Undefined method Twilio::' . $method . '() called');
}
 
return call_user_func_array( array($this->_twilio, $method), $arguments);
}
 
/**
* Send SMS
*
* @desc Send a basic SMS
*
* @param <int> Phone Number
* @param <string> Text Message
*/
public function sms($from, $to, $message)
{
$url = '/' . $this->api_version . '/Accounts/' . $this->account_sid . '/Messages';
 
$data = array(
'From' => $from,
'To' => $to,
'Body' => $message,
);
 
if ($this->mode == 'sandbox')
$data['From'] = $this->number;
 
return $this->_twilio->request($url, 'POST', $data);
}
 
}
 
// VERSION: 2.0.8
 
// Twilio REST Helpers
// ========================================================================
 
// ensure Curl is installed
if(!extension_loaded("curl"))
throw(new Exception(
"Curl extension is required for TwilioRestClient to work"));
class TwilioRestResponse {
 
public $ResponseText;
public $ResponseXml;
public $HttpStatus;
public $Url;
public $QueryString;
public $IsError;
public $ErrorMessage;
 
public function __construct($url, $text, $status) {
preg_match('/([^?]+)\??(.*)/', $url, $matches);
$this->Url = $matches[1];
$this->QueryString = $matches[2];
$this->ResponseText = $text;
$this->HttpStatus = $status;
if($this->HttpStatus != 204)
$this->ResponseXml = @simplexml_load_string($text);
 
if($this->IsError = ($status >= 400))
$this->ErrorMessage =
(string)$this->ResponseXml->RestException->Message;
 
}
 
}
 
class TwilioException extends Exception {}
 
class TwilioRestClient {
 
protected $Endpoint;
protected $AccountSid;
protected $AuthToken;
public function __construct($accountSid, $authToken,
$endpoint = "https://api.twilio.com") {
 
$this->AccountSid = $accountSid;
$this->AuthToken = $authToken;
$this->Endpoint = $endpoint;
}
public function request($path, $method = "GET", $vars = array()) {
$fp = null;
$tmpfile = "";
$encoded = "";
foreach($vars AS $key=>$value)
$encoded .= "$key=".urlencode($value)."&";
$encoded = substr($encoded, 0, -1);
 
// construct full url
$url = "{$this->Endpoint}/$path";
 
// if GET and vars, append them
if($method == "GET")
$url .= (FALSE === strpos($path, '?')?"?":"&").$encoded;
 
// initialize a new curl object
$curl = curl_init($url);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
 
curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
switch(strtoupper($method)) {
case "GET":
curl_setopt($curl, CURLOPT_HTTPGET, TRUE);
break;
case "POST":
curl_setopt($curl, CURLOPT_POST, TRUE);
curl_setopt($curl, CURLOPT_POSTFIELDS, $encoded);
break;
case "PUT":
// curl_setopt($curl, CURLOPT_PUT, TRUE);
curl_setopt($curl, CURLOPT_POSTFIELDS, $encoded);
curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
file_put_contents($tmpfile = tempnam("/tmp", "put_"),
$encoded);
curl_setopt($curl, CURLOPT_INFILE, $fp = fopen($tmpfile,
'r'));
curl_setopt($curl, CURLOPT_INFILESIZE,
filesize($tmpfile));
break;
case "DELETE":
curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE");
break;
default:
throw(new TwilioException("Unknown method $method"));
break;
}
 
// send credentials
curl_setopt($curl, CURLOPT_USERPWD,
$pwd = "{$this->AccountSid}:{$this->AuthToken}");
 
// do the request. If FALSE, then an exception occurred
if(FALSE === ($result = curl_exec($curl)))
throw(new TwilioException(
"Curl failed with error " . curl_error($curl)));
 
// get result code
$responseCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
 
// unlink tmpfiles
if($fp)
fclose($fp);
if(strlen($tmpfile))
unlink($tmpfile);
 
return new TwilioRestResponse($url, $result, $responseCode);
}
}
 
class Verb {
private $tag;
private $body;
private $attr;
private $children;
 
/*
* __construct
* $body : Verb contents
* $body : Verb attributes
*/
function __construct($body=NULL, $attr = array()) {
if (is_array($body)) {
$attr = $body;
$body = NULL;
}
$this->tag = get_class($this);
$this->body = $body;
$this->attr = array();
$this->children = array();
self::addAttributes($attr);
}
private function addAttributes($attr) {
foreach ($attr as $key => $value) {
if(in_array($key, $this->valid))
$this->attr[$key] = $value;
else
throw new TwilioException($key . ', ' . $value .
" is not a supported attribute pair");
}
}
 
/*
* append
* Nests other verbs inside self.
*/
function append($verb) {
if(is_null($this->nesting))
throw new TwilioException($this->tag ." doesn't support nesting");
else if(!is_object($verb))
throw new TwilioException($verb->tag . " is not an object");
else if(!in_array(get_class($verb), $this->nesting))
throw new TwilioException($verb->tag . " is not an allowed verb here");
else {
$this->children[] = $verb;
return $verb;
}
}
function set($key, $value){
$this->attr[$key] = $value;
}
 
/* Convenience Methods */
function addSay($body=NULL, $attr = array()){
return self::append(new Say($body, $attr));
}
 
function addPlay($body=NULL, $attr = array()){
return self::append(new Play($body, $attr));
}
 
function addDial($body=NULL, $attr = array()){
return self::append(new Dial($body, $attr));
}
 
function addNumber($body=NULL, $attr = array()){
return self::append(new Number($body, $attr));
}
 
function addGather($attr = array()){
return self::append(new Gather($attr));
}
 
function addRecord($attr = array()){
return self::append(new Record(NULL, $attr));
}
 
function addHangup(){
return self::append(new Hangup());
}
 
function addRedirect($body=NULL, $attr = array()){
return self::append(new Redirect($body, $attr));
}
 
function addPause($attr = array()){
return self::append(new Pause($attr));
}
 
function addConference($body=NULL, $attr = array()){
return self::append(new Conference($body, $attr));
}
 
function addSms($body=NULL, $attr = array()){
return self::append(new Sms($body, $attr));
}
protected function write($parent, $writeself=TRUE){
if($writeself) {
$elem = $parent->addChild($this->tag, htmlspecialchars($this->body));
foreach($this->attr as $key => $value)
$elem->addAttribute($key, $value);
foreach($this->children as $child)
$child->write($elem);
} else {
foreach($this->children as $child)
$child->write($parent);
}
 
}
 
}
class Response extends Verb {
 
private $xml = "<?xml version=\"1.0\" encoding=\"UTF-8\"?><Response></Response>";
 
protected $nesting = array('Say', 'Play', 'Gather', 'Record',
'Dial', 'Redirect', 'Pause', 'Hangup', 'Sms');
 
function __construct(){
parent::__construct(NULL);
}
 
function Respond($sendHeader = true) {
// try to force the xml data type
// this is generally unneeded by Twilio, but nice to have
if($sendHeader)
{
if(!headers_sent())
{
header("Content-type: text/xml");
}
}
$simplexml = new SimpleXMLElement($this->xml);
$this->write($simplexml, FALSE);
print $simplexml->asXML();
}
 
function asURL($encode = TRUE){
$simplexml = new SimpleXMLElement($this->xml);
$this->write($simplexml, FALSE);
if($encode)
return urlencode($simplexml->asXML());
else
return $simplexml->asXML();
}
 
}
 
class Say extends Verb {
 
protected $valid = array('voice','language','loop');
 
}
 
class Reject extends Verb {
 
protected $valid = array('reason');
 
}
 
class Play extends Verb {
 
protected $valid = array('loop');
 
}
class Record extends Verb {
 
protected $valid = array('action','method','timeout','finishOnKey',
'maxLength','transcribe','transcribeCallback', 'playBeep');
 
}
class Dial extends Verb {
 
protected $valid = array('action','method','timeout','hangupOnStar',
'timeLimit','callerId');
 
protected $nesting = array('Number','Conference');
 
}
 
class Redirect extends Verb {
 
protected $valid = array('method');
 
}
 
class Pause extends Verb {
 
protected $valid = array('length');
 
function __construct($attr = array()) {
parent::__construct(NULL, $attr);
}
 
}
 
class Hangup extends Verb {
 
function __construct() {
parent::__construct(NULL, array());
}
}
class Gather extends Verb {
 
protected $valid = array('action','method','timeout','finishOnKey',
'numDigits');
 
protected $nesting = array('Say', 'Play', 'Pause');
 
function __construct($attr = array()){
parent::__construct(NULL, $attr);
}
 
}
 
class Number extends Verb {
 
protected $valid = array('url','sendDigits');
 
}
 
class Conference extends Verb {
 
protected $valid = array('muted','beep','startConferenceOnEnter',
'endConferenceOnExit','waitUrl','waitMethod');
 
}
 
class Sms extends Verb {
protected $valid = array('to', 'from', 'action', 'method', 'statusCallback');
}
 
// Twilio Utility function and Request Validation
// ========================================================================
 
class TwilioUtils {
 
protected $AccountSid;
protected $AuthToken;
 
function __construct($id, $token){
$this->AuthToken = $token;
$this->AccountSid = $id;
}
 
public function validateRequest($expected_signature, $url, $data = array()) {
 
// sort the array by keys
ksort($data);
 
// append them to the data string in order
// with no delimiters
foreach($data AS $key=>$value)
$url .= "$key$value";
 
// This function calculates the HMAC hash of the data with the key
// passed in
// Note: hash_hmac requires PHP 5 >= 5.1.2 or PECL hash:1.1-1.5
// Or http://pear.php.net/package/Crypt_HMAC/
$calculated_signature = base64_encode(hash_hmac("sha1",$url, $this->AuthToken, true));
 
return $calculated_signature == $expected_signature;
 
}
 
}
?>