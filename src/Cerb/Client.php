<?php
namespace Cerb;

use Cerb\Model\Ticket;
use stdClass;

class Client
{
    /**
     * @var string
     */
    private $uri;
    /**
     * @var string
     */
    private $accessKey;
    /**
     * @var string
     */
    private $secretKey;
    /**
     * @var CurlCaller
     */
    private $curlCaller;

    /**
     * @param string $uri
     * @param string $accessKey
     * @param string $secretKey
     * @param null|CurlCaller $curlCaller
     */
    public function __construct($uri, $accessKey, $secretKey, CurlCaller $curlCaller = null)
    {
        $this->uri = rtrim($uri, '/');
        $this->accessKey = $accessKey;
        $this->secretKey = $secretKey;
        $this->curlCaller = $curlCaller ?: new CurlCaller($this->uri, $this->accessKey, $this->secretKey);
    }

    /**
     * @param string $resource
     * @return stdClass
     */
    private function get($resource)
    {
        return $this->call('GET', $resource);
    }

    /**
     * @param string $resource
     * @param null|array|string $payload
     * @return stdClass
     */
    private function put($resource, $payload = null)
    {
        return $this->call('PUT', $resource, $payload);
    }

    /**
     * @param string $resource
     * @param null|array|string $payload
     * @return stdClass
     */
    private function post($resource, $payload = null)
    {
        return $this->call('POST', $resource, $payload);
    }

    /**
     * @param string $resource
     * @return stdClass
     */
    private function delete($resource)
    {
        return $this->call('DELETE', $resource);
    }

    /**
     * @param string $verb
     * @param string $resource
     * @param null|array|string $payload
     * @return stdClass
     */
    private function call($verb, $resource, $payload = null)
    {
        return $this->curlCaller->call($verb, $resource, $payload);
    }

    /**
     * @param array|string $where
     *
     * @return stdClass
     */
    public function getTickets($where)
    {
        return $this->post('/tickets/search.json', $where);
    }

    /**
     * @param array|int $id
     *
     * @return stdClass
     */
    public function getTicket($id)
    {
        return $this->get(sprintf('/tickets/%s.json', $id));
    }

    /**
     * @param string $payload
     *
     * @return stdClass
     */
    public function postTicket($payload)
    {
        return $this->post('/tickets/compose.json', $payload);
    }

    /**
     * @param string $id Attachement id
     *
     * @return stdClass
     */
    public function getAttachementDetails($id)
    {
        return $this->get(sprintf('/attachments/%s/.json', $id));
    }

    /**
     * @param string $id Attachement id
     *
     * @return stdClass
     */
    public function getAttachementContent($id)
    {
        return $this->get(sprintf('/attachments/%s/download.json', $id));
    }

    /**
     * @param string $payload
     *
     * @return stdClass
     */
    public function postAttachement($payload)
    {
        return $this->post('/attachments/upload.json', $payload);
    }
}
