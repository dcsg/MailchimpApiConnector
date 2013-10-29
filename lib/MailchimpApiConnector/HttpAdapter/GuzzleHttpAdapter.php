<?php

/**
 * This file is part of the Geocoder package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license    MIT License
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
            $response = $this->client->post($url, $headers, $content, $options);
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
