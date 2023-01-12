<?php
namespace App\Utils;

class CurlRequest
{
    /**
     * A get request to another site.
     *
     * Ex: Curl::get('http://google.com/') will return the standard curl response from google
     *ss
     * @param $url string The url of the site
     * @param string $language string The response language (currently json or xml, they will be automatically parsed)
     * @param $customCurl array  Any custom curl options that need to be added in the form of array(OPTION => 'value');
     * @return bool|mixed|SimpleXMLElement|string The response from the server
     */
    static function get($url, $language = 'json', $customCurl = array())
    {
        $param = array(
            CURLOPT_URL => $url,
        );

        if(count($customCurl) > 0)
        {
            foreach($customCurl as $key => $value)
            {
                $param[$key] = $value;
            }
        }
        $response = self::base($param);
        if ($language != '')
        {
            return self::parse($response, $language);
        }
        else
        {
            return $response;
		}
    }

    /**
     * A post request to another site.
     *
     * Ex: Curl::post('http://google.com/', array('item1' => 'something', 'json')) will send post data to google and return a decoded json string
     *
     * @param $url string The url of the site.
     * @param $postdata array  POST data to send to the site.
     * @param string $language string The response language (currently json or xml, they will be automatically parsed).
     * @param array $customCurl array  Any custom curl options that need to be added in the form of array(OPTION => 'value');
     * @return bool|mixed|SimpleXMLElement|string The response from the server
     */
    static function post($url, $postdata, $language = '', $customCurl = array())
    {
        //print_r(json_encode($postdata));
        $param = array(
            CURLOPT_URL => $url,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($postdata, true),
        );

        if(count($customCurl) > 0)
        {
            foreach($customCurl as $key => $value)
            {
                $param[$key] = $value;
            }
        }
        $response = self::base($param);
        if ($language != '')
        {
            return self::parse($response, $language);
        }
        else
        {
            return $response;
		}
    }

    /**
     * A delete request to another site.
     *
     * Ex: Curl::delete('http://google.com/') will return the delete curl response from google
     *
     * @param $url string The url of the site
     * @return bool|string The response from the server
     */
    static function delete($url)
    {
        $param = array(
            CURLOPT_URL => $url,
            CURLOPT_CUSTOMREQUEST => 'DELETE',
        );
        $response = self::base($param);
        return $response;
    }

    /**
     * The base request to actually execute the curl request
     *
     * @param $param array The parameters for the curlopt() options.
     * @return bool|string The response from the server
     */
    static private function base($param)
    {
        $ch = curl_init();
        $header = array(
            "x-client-id:".CF_API_KEY,
            "x-client-secret:".CF_API_SECRET,
            "x-api-version:2022-09-01",
            "Content-Type:application/json"
        );
        foreach($param as $constant => $value)
        {
            curl_setopt($ch, $constant, $value);
        }
        curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt ($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLINFO_HEADER_OUT, true);
        $response = curl_exec($ch);

        $info = curl_getinfo($ch);

        // var_dump(curl_error($ch));
        curl_close($ch);

        return $response;
    }

    /**
     * Parses a string and returns decoded information
     *
     * @param $response string The string response from the server.
     * @param $language string The language of the response string.
     * @return mixed|SimpleXMLElement|string
     */

    static private function parse($response, $language)
    {
        $data = "";
        switch($language)
        {
            case 'json':
                $data =  json_decode($response, true);
                break;
            case 'xml':
                $data = simplexml_load_string($response);
                break;
        }

        return  $data;

    }
}