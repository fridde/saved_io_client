<?php

namespace Fridde;

class Bookmark {
	
	private $title;	
	private $url;
	
	public function __construct($title, $url)
	{
		$this->setTitle($title);
		$this->setUrl($url);
	}
	
	
	public function setTitle($title)
	{
		$this->title = $title;
	}
	
	public function getTitle()
	{
		return $this->title;
	}
	
	public function setUrl($url)
	{
		$this->url = $url;
	}
	
	public function getUrl()
	{
		return $this->url;
	}
}