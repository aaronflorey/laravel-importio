<?php

namespace Mochaka\Importio;

use Guzzle\Http\Client;

class Importio
{
	private $connectorGuid;

	public function __construct($userGuid, $apiKey)
	{
        $this->userGuid = $userGuid;
        $this->apiKey = $apiKey;
	}

	public function query($input, $additionalInput = '')
	{
		return $this->sendRequest($input, $additionalInput);
	}

	public function setConnectorGuid($connectorGuid)
	{
		$this->connectorGuid = $connectorGuid;
		return $this;
	}

	private function sendRequest($input, $additionalInput = '')
	{
		if(!$this->connectorGuid || !$this->userGuid || !$this->apiKey) throw new \Exception('Missing parameters, please check your config file.');
        $client = new Client();
        $url = "https://api.import.io/store/connector/".$this->connectorGuid."/_query?_user=".urlencode($this->userGuid)."&_apikey=".urlencode($this->apiKey);

		$data = array("input" => $input);
		if ($additionalInput) {
			$data["additionalInput"] = $additionalInput;
		}

		$request = $client->createRequest('POST', $url);
		$request->setBody(json_encode($data), 'application/json');
		return $request->send()->json();
	}
}