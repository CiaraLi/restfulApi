<?php
define('APIURL', 'http://localhost:81/restfulApi/');


$ch = new curl();

$url = APIURL.'api/product';
$rand = rand();
$ch->postdata($url, array('isbn' => '1' . $rand, 'title' => 'book' . $rand));
print_r("\r\n<br/>---添加图书:" . 'book' . $rand . "--- \r\n<br/>");
echo $ch->run();


$url = APIURL.'api/product';
$ch->getdata($url);
print_r("\r\n<br/>---图书列表--- \r\n<br/>");
echo $json = $ch->run();

$list = json_decode($json, true);
//var_dump($list);

if (count($list)) {
    $rand = $list[rand(0, count($list) - 1)]['id'];
    $url = APIURL.'api/product/' . intval($rand);
    $data = array('isbn' => '1' . $rand, 'title' => 'book' . $rand);
    $ch->putdata($url, ($data));
    print_r("\r\n<br/>---修改图书:$rand --- \r\n<br/>");
    echo $ch->run();

    $rand = rand(-1, count($list) - 1);
    if ($rand > 0) {
        $id=$list[$rand]['id'];
        $url = APIURL.'api/product/' . intval($id);
        $ch->deldata($url);
        print_r("\r\n<br/>---删除图书:$id--- \r\n<br/>");
        echo $ch->run();
    }
}

class curl {

    protected $ch;
    protected $timeout;

    function __contstuct() {
        $this->ch = curl_init();
        $this->timeout = 5;
    }

    function getdata($url, $data = "") {
        $this->ch = curl_init();
        curl_setopt($this->ch, CURLOPT_URL, $url);
        curl_setopt($this->ch, CURLOPT_CONNECTTIMEOUT, $this->timeout);
        curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($this->ch, CURLOPT_ACCEPT_ENCODING, 'application/xml');
//        curl_setopt($this->ch, CURLOPT_POST, false);
//        curl_setopt($this->ch, CURLOPT_POSTFIELDS, $data);
    }

    function postdata($url, $data) {
        $this->ch = curl_init();
        curl_setopt($this->ch, CURLOPT_URL, $url);
        curl_setopt($this->ch, CURLOPT_CONNECTTIMEOUT, $this->timeout);
        curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($this->ch, CURLOPT_POST, true);
        curl_setopt($this->ch, CURLOPT_POSTFIELDS, $data);
    }

    function putdata($url, $data) {
        $this->ch = curl_init();
        curl_setopt($this->ch, CURLOPT_URL, $url);
        curl_setopt($this->ch, CURLOPT_CONNECTTIMEOUT, $this->timeout);
        curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($this->ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($this->ch, CURLOPT_CUSTOMREQUEST, 'PUT');
        curl_setopt($this->ch, CURLOPT_HTTPHEADER, array("X-HTTP-Method-Override: PUT")); //设置HTTP头信息 
    }

    function deldata($url, $data = "") {
        $this->ch = curl_init();
        curl_setopt($this->ch, CURLOPT_URL, $url);
        curl_setopt($this->ch, CURLOPT_CONNECTTIMEOUT, $this->timeout);
        curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($this->ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
        curl_setopt($this->ch, CURLOPT_POSTFIELDS, $data);
    }

    function patchdata($url, $data) {
        $this->ch = curl_init();
        curl_setopt($this->ch, CURLOPT_URL, $url);
        curl_setopt($this->ch, CURLOPT_CONNECTTIMEOUT, $this->timeout);
        curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($this->ch, CURLOPT_CUSTOMREQUEST, 'PATCH');
        curl_setopt($this->ch, CURLOPT_POSTFIELDS, $data);
    }

    function run() {
        $file_content = curl_exec($this->ch);
        curl_close($this->ch);
        RETURN $file_content;
    }

}
