<?php
class GoogleAuth
{
	protected $client;
	public function __construct(Google_Client $googleClient = null)
	{
		$this->client = $googleClient;
		if($this->client)
		{
			$this->client->setClientId('101187768920-n430ocha4u81nna03hcn1ic6eb4cbob0.apps.googleusercontent.com');
			$this->client->setClientSecret('6UuWFDWxvexokLeBOaIwvIyG');
			$this->client->setRedirectUri('http://localhost:8080/projects/googleLogin/');
			$this->client->setScopes('email');
		}
	}

	public function isLoggedIn()
	{
		return isset($_SESSION['access_token']);
	}

	public function getAuthUrl()
	{
		return $this->client->createAuthUrl();
	}

	public function checkRedirectCode()
	{
		if(isset($_GET['code']))
		{
			$this->client->authenticate($_GET['code']);
			$this->setToken($this->client->getAccessToken());


			return true;
		}
		return false;
	}

	public function setToken($token)
	{
		$_SESSION['access_token'] = $token;
		$this->client->setAccessToken($token);
	}
}
?>