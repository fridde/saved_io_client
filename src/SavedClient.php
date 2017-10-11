<?php

namespace Fridde;

use GuzzleHttp\Client;

class SavedClient {
	
	private $guzzle;
	private $timeout = 2.0;
	private $keys;
	private $keyfile = 'keys.ini';
	private $api_url = 'http://devapi.saved.io/bookmarks/';
	//private $filename = "input/bookmarks.json";	
	
	public function __construct()
	{
		$this->guzzle = new Client(['timeout'  => $this->timeout]);		
		$this->keys = parse_ini_file($this->keyfile);
	}
	
	public function saveBookmark($bookmark)
	{
		$query = $this->keys;
		$query["title"] = $bookmark->getTitle();
        $query["url"] = $bookmark->getUrl();		        
        $response = $this->guzzle->request('POST', $this->api_url, ['query' => $query);
		sleep(0.1);
	}
	
}