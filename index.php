<?php
$data=[
	'name'=>'ciara'
]; 
$url='http://localhost:81/restfulApi/api.php';

$ch=new curl();
$ch->getdata($url,$data); 
echo $ch->run();;

class curl{
    protected $ch;
    protected $timeout;
    
    function __contstuct(){
    	$this->ch=curl_init();
    	$this->timeout=5;
    }
	
	function getdata($url,$data){
		$this->ch=curl_init();
		curl_setopt($this->ch,CURLOPT_URL,$url);
		curl_setopt($this->ch,CURLOPT_CONNECTTIMEOUT,$this->timeout);
		curl_setopt($this->ch,CURLOPT_RETURNTRANSFER,1);
		curl_setopt($this->ch,CURLOPT_POST,false);
		curl_setopt($this->ch,CURLOPT_POSTFIELDS,$data);
	}
	function postdata($url,$data){
		$this->ch=curl_init();
		curl_setopt($this->ch,CURLOPT_URL,$url);
		curl_setopt($this->ch,CURLOPT_CONNECTTIMEOUT,$this->timeout);
		curl_setopt($this->ch,CURLOPT_RETURNTRANSFER,1);
		curl_setopt($this->ch,CURLOPT_POST,true);
		curl_setopt($this->ch,CURLOPT_POSTFIELDS,$data);
	}
	function putdata($url,$data){
		$this->ch=curl_init();
		curl_setopt($this->ch,CURLOPT_URL,$url);
		curl_setopt($this->ch,CURLOPT_CONNECTTIMEOUT,$this->timeout);
		curl_setopt($this->ch,CURLOPT_RETURNTRANSFER,1);
		curl_setopt($this->ch,CURLOPT_PUT,true);
		curl_setopt($this->ch,CURLOPT_POSTFIELDS,$data);
	}
	function deldata($url,$data){
		$this->ch=curl_init();
		curl_setopt($this->ch,CURLOPT_URL,$url);
		curl_setopt($this->ch,CURLOPT_CONNECTTIMEOUT,$this->timeout);
		curl_setopt($this->ch,CURLOPT_RETURNTRANSFER,1);
		curl_setopt($this->ch,CURLOPT_CUSTOMREQUEST,'DELETE');
		curl_setopt($this->ch,CURLOPT_POSTFIELDS,$data);
	}
	function patchdata($url,$data){
		$this->ch=curl_init();
		curl_setopt($this->ch,CURLOPT_URL,$url);
		curl_setopt($this->ch,CURLOPT_CONNECTTIMEOUT,$this->timeout);
		curl_setopt($this->ch,CURLOPT_RETURNTRANSFER,1);
		curl_setopt($this->ch,CURLOPT_CUSTOMREQUEST,'PATCH');
		curl_setopt($this->ch,CURLOPT_POSTFIELDS,$data);
	}
	
	function run(){
		$file_content=curl_exec($this->ch);
		curl_close($this->ch);
		RETURN $file_content;
	}
}