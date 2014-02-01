<?php

/*
 * This file is part of the MailchimpApiConnector package.
 *
 * (c) 2013-2014 Daniel Gomes <me@danielcsgomes.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 *
 */

namespace MailchimpApiConnector\HttpAdapter;

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
