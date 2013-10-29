<?php

/**
 * This file is part of the Geocoder package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license    MIT License
 */

namespace MailchimpApiConnector\HttpAdapter;

use MailchimpApiConnector\HttpAdapter\HttpAdapterInterface;
use Zend\Http\Client;
use Zend\Http\Request;

/**
 * @author William Durand <william.durand1@gmail.com>
 */
class ZendHttpAdapter implements HttpAdapterInterface
{
    /**
     * @var Client
     */
    protected $client;

    /**
     * @param Client $client Client object
     */
    public function __construct(Client $client = null)
    {
        $this->client = null === $client ? new Client() : $client;
    }

    /**
     * {@inheritdoc}
     */
    public function getContent($url)
    {
        try {
            $response = $this->client->setUri($url)->send();
            $content = $response->isSuccess() ? $response->getBody() : null;
        } catch (\Exception $e) {
            $content = null;
        }

        return $content;
    }

    /**
     * {@inheritdoc}
     */
    public function postContent($url, $headers = array(), $content = '', array $options = array())
    {
        try {
            $this->client->setUri($url);
            $this->client->setMethod(Request::METHOD_POST);
            $this->client->setHeaders($headers);
            $this->client->setRawBody($content);
            $response = $this->client->send();
            $content = $response->isSuccess() ? $response->getBody() : null;
        } catch (\Exception $e) {
            $content = null;
        }

        return $content;
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'zend';
    }
}
