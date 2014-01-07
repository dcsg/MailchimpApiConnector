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

use Guzzle\Service\Client;
use Guzzle\Service\ClientInterface;

/**
 * Http adapter for the Guzzle framework
 *
 * @author Michael Dowling <michael@guzzlephp.org>
 * @link   http://www.guzzlephp.org
 */
class GuzzleHttpAdapter implements HttpAdapterInterface
{
    /**
     * @var ClientInterface
     */
    protected $client;

    /**
     * @param ClientInterface $client Client object
     */
    public function __construct(ClientInterface $client = null)
    {
        $this->client = null === $client ? new Client() : $client;
    }

    /**
     * {@inheritdoc}
     */
    public function getContent($url)
    {
        $response = $this->client->get($url)->send();

        return (string) $response->getBody();
    }

    /**
     * {@inheritdoc}
     */
    public function postContent($url, $headers = array(), $content = '', array $options = array())
    {
        try {
            $request = $this->client->post($url, $headers, $content, $options);
            $response = $this->client->send($request);
            $content = (string) $response->getBody();
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
        return 'guzzle';
    }
}
