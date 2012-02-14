<?php

/**
* 
*/
class Superfeedr
{
	
	private $topic;
	private $callback;
	private $hub = 'http://superfeedr.com/hubbub';
	public $verbose = false;
	
	function __construct($topic, $callback, $hub='')
	{
		$this->topic = $topic;
		$this->callback = $callback;
		if ($hub) {
			$this->hub = $hub;
		}
	}
	
	public function subscribe()
	{
		$this->request('subscribe');
	}
	
	public function unsubscribe()
	{
		$this->request('unsubscribe');
	}
	
	private function request($mode)
	{
		$data = array();
		$data['topic'] = $this->topic;
		$data['callback'] = $this->callback;
		
		$post_data = array ( 
		        "hub.mode" => $mode, 
		        "hub.verify" => "sync", 
		        "hub.callback" => $this->callback, 
		        "hub.topic" => $this->topic
		); 
		
		// url-ify the data for the POST 
		foreach ($post_data as $key=>$value) { 
			$post_data_string .= $key.'='. $value.'&'; 
		} 
		rtrim($fields_string,'&'); 
		
		// curl request
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_URL, $this->hub); 
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true); 
		curl_setopt($ch, CURLOPT_POST, true); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data_string); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
		curl_setopt($ch, CURLOPT_HEADER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json'));
		curl_setopt($ch, CURLOPT_USERPWD, 'USERNAME:PASSWORD');
		$output = curl_exec($ch);
		
		if ($this->verbose) {
			print('<pre>'); 
			print_r($output); 
			print('</pre>');
		} 	
	}	
}





?>