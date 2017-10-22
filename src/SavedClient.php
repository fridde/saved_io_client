<?php

namespace Fridde;

use GuzzleHttp\Client;

class SavedClient {
	
	private $guzzle;
	private $timeout = 2.0;
	private $keys;
	private $api_url = 'http://devapi.saved.io/bookmarks/';
	//private $filename = "input/bookmarks.json";	
	
	public function __construct($keys)
	{
		$this->guzzle = new Client(['timeout'  => $this->timeout]);		
		$this->keys = $keys;
	}
	
	public function saveBookmark($bookmark)
	{
		$query = $this->keys;
		$query["title"] = $bookmark->getTitle();
        $query["url"] = $bookmark->getUrl();		        
        $response = $this->guzzle->request('POST', $this->api_url, ['query' => $query]);
		if($response->getStatusCode() == '200'){
            sleep(0.1);
        } else {
		    throw new \Exception('Couldn\'t add bookmark. Response returned bad.');
        }
	}
	
}