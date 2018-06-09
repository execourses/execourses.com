<?php

class twitter_oauth
    {
      var $key = '';
      var $secret = '';

      var $request_token = "https://twitter.com/oauth/request_token";
	  var $access_token  = "https://twitter.com/oauth/access_token";
	  var $profile		 = "https://api.twitter.com/1.1/account/verify_credentials.json";

    function __construct($client_key,$client_secret)
    {
        $this->key = $client_key; // consumer key from twitter
        $this->secret = $client_secret; // secret from twitter
    }

    function getRequestToken()
    {
        // Default params
        $params = array(
            "oauth_version" => "1.0",
            "oauth_nonce" => time(),
            "oauth_timestamp" => time(),
            "oauth_consumer_key" => $this->key,
            "oauth_signature_method" => "HMAC-SHA1"
         );

         // BUILD SIGNATURE
            // encode params keys, values, join and then sort.
            $keys = $this->_urlencode_rfc3986(array_keys($params));
            $values = $this->_urlencode_rfc3986(array_values($params));
            $params = array_combine($keys, $values);
            uksort($params, 'strcmp');

            // convert params to string 
            foreach ($params as $k => $v) {
				$pairs[] = $this->_urlencode_rfc3986($k).'='.$this->_urlencode_rfc3986($v);
			}
            $concatenatedParams = implode('&', $pairs);

            // form base string (first key)
            $baseString= "GET&".$this->_urlencode_rfc3986($this->request_token)."&".$this->_urlencode_rfc3986($concatenatedParams);
            // form secret (second key)
            $secret = $this->_urlencode_rfc3986($this->secret)."&";
            // make signature and append to params
            $params['oauth_signature'] = $this->_urlencode_rfc3986(base64_encode(hash_hmac('sha1', $baseString, $secret, TRUE)));

			// BUILD URL
            // Resort
            uksort($params, 'strcmp');
            // convert params to string 
            foreach ($params as $k => $v) {$urlPairs[] = $k."=".$v;}
            $concatenatedUrlParams = implode('&', $urlPairs);
            // form url
            $url = $this->request_token."?".$concatenatedUrlParams;

			// Send to cURL
			return $this->_http($url);          
    }
	
	function getAccessToken($oauth_verifier,$twitter_oauth_token)
    {
        $params = array(
            "oauth_version" => "1.0",
            "oauth_nonce" => time(),
            "oauth_timestamp" => time(),
            "oauth_consumer_key" => $this->key,
			"oauth_token" => $twitter_oauth_token,
            "oauth_signature_method" => "HMAC-SHA1"
         );

		$keys = $this->_urlencode_rfc3986(array_keys($params));
		$values = $this->_urlencode_rfc3986(array_values($params));
		$params = array_combine($keys, $values);
		uksort($params, 'strcmp');

		foreach ($params as $k => $v) {
			$pairs[] = $this->_urlencode_rfc3986($k).'='.$this->_urlencode_rfc3986($v);
		}
		$concatenatedParams = implode('&', $pairs);

		$baseString= "GET&".$this->_urlencode_rfc3986($this->access_token)."&".$this->_urlencode_rfc3986($concatenatedParams);
		$secret = $this->_urlencode_rfc3986($this->secret)."&";
		$params['oauth_signature'] = $this->_urlencode_rfc3986(base64_encode(hash_hmac('sha1', $baseString, $secret, TRUE)));

		uksort($params, 'strcmp');
		foreach ($params as $k => $v) {$urlPairs[] = $k."=".$v;}
		$concatenatedUrlParams = implode('&', $urlPairs);
		$url = $this->access_token."?".$concatenatedUrlParams;
		$postData = 'oauth_verifier=' .$oauth_verifier;

		return $this->_http($url,$postData);          
    }
		
	function getprofile_signature($oauth_token,$oauth_token_secret,$screen_name)
    {
        $params = array(
            "oauth_version" => "1.0",
            "oauth_nonce" => time(),
            "oauth_timestamp" => time(),
            "oauth_consumer_key" => $this->key,
			"oauth_token" => $oauth_token,
            "oauth_signature_method" => "HMAC-SHA1",
			"screen_name" => $screen_name,
            "include_email" => "true"
         );
    
		$keys = $this->_urlencode_rfc3986(array_keys($params));
		$values = $this->_urlencode_rfc3986(array_values($params));
		$params = array_combine($keys, $values); 
		uksort($params, 'strcmp');

		foreach ($params as $k => $v) {
			$pairs[] = $this->_urlencode_rfc3986($k).'='.$this->_urlencode_rfc3986($v);
		}
		$concatenatedParams = implode('&', $pairs);
		
		$baseString= "GET&".$this->_urlencode_rfc3986($this->profile)."&".$this->_urlencode_rfc3986($concatenatedParams);
		
		$secret = $this->_urlencode_rfc3986($this->secret)."&". $this->_urlencode_rfc3986($oauth_token_secret);
		$params['oauth_signature'] = $this->_urlencode_rfc3986(base64_encode(hash_hmac('sha1', $baseString, $secret, TRUE)));
		
	 	uksort($params, 'strcmp');
		foreach ($params as $k => $v) {$urlPairs[] = $k."=".$v;}
		$concatenatedUrlParams = implode('&', $urlPairs);
		$url = $this->profile."?".$concatenatedUrlParams;
		return $this->get_profile($url);         
    }

    function _http($url, $post_data = null)
    {       
        $ch = curl_init();
		//echo $url; exit;

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

        if(isset($post_data))
        {
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
        }

        $response = curl_exec($ch);
		mo_openid_start_session();

        $this->http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $this->last_api_call = $url;
        curl_close($ch);

		if($post_data != null)
        {
			return $response;
        }
		else
		{
			$dirs = explode('&', $response);
			$dirs1 = explode('=', $dirs[0]);
			return $dirs1[1];
		}
		
    }
	  
	function get_profile($url, $post_data = null)
    {       
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

        if(isset($post_data))
        {
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
        }

        $response = curl_exec($ch);
		$profile_json_output = json_decode($response, true);
        
		
		return  $profile_json_output;
		curl_close($ch);
	}

    function _urlencode_rfc3986($input)
    {
        if (is_array($input)) {
            return array_map(array('twitter_oauth', '_urlencode_rfc3986'), $input);
        }
        else if (is_scalar($input)) {
            return str_replace('+',' ',str_replace('%7E', '~', rawurlencode($input)));
        }
        else{
            return '';
        }
    }
}
?>