<?php

/**
 * This file is part of the MailchimpApi package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license    MIT License
 */

namespace MailchimpApi;

use MailchimpApi\Exception\MailchimpApiException;
use MailchimpApi\HttpAdapter\HttpAdapterInterface;

/**
 * Class AbstractMailchimpApi
 * @package MailchimpApi
 * @author Daniel Gomes <me@danielcsgomes.com>
 * @todo Add option to connect the API by using the POST method and HTTPS
 */
abstract class AbstractMailchimpApi implements MailchimpApiInterface
{
    /**
     * Possible Formats Constants
     */
    const FORMAT_JSON = 'json';
    const FORMAT_PHP = 'php';
    const FORMAT_XML = 'xml';
    const FORMAT_LOLCODE = 'lolcode';
    /**
     * @version
     */
    const VERSION = '2.0.0-dev';
    /**
     * @const string URL Format to call the API
     */
    const API_URL = "";
    /**
     * @var HttpAdapterInterface
     */
    protected $adapter;
    /**
     * @var string
     */
    protected $apiKey;
    /**
     * @var float
     */
    protected $apiVersion;
    /**
     * @var string
     */
    protected $content;
    /**
     * @var string
     */
    protected $dc = 'us1';

    /**
     * @param HttpAdapterInterface $adapter
     * @param string               $apiKey
     */
    public function __construct(HttpAdapterInterface $adapter, $apiKey)
    {
        $this->setApiKey($apiKey);
        $this->setAdapter($adapter);
    }

    /**
     * {@inheritDoc}
     */
    public function getAdapter()
    {
        return $this->adapter;
    }

    /**
     * {@inheritDoc}
     */
    public function setAdapter(HttpAdapterInterface $adapter)
    {
        $this->adapter = $adapter;
    }

    /**
     * {@inheritDoc}
     */
    public function getApiKey()
    {
        return $this->apiKey;
    }

    /**
     * {@inheritDoc}
     */
    public function setApiKey($key)
    {
        if (strlen($key) < 1) {
            throw new MailchimpApiException('Please provide your Mailchimp API key.');
        }

        $dc = substr($key, -(strlen($key) - (strpos($key, '-') + 1)));
        if (strlen($dc) > 2) {
            $this->setDc($dc);
        }

        $this->apiKey = $key;
    }

    /**
     * {@inheritDoc}
     */
    public function getApiVersion()
    {
        return $this->apiVersion;
    }

    /**
     * {@inheritDoc}
     */
    public function setApiVersion($version)
    {
        $this->apiVersion = $version;
    }

    /**
     * {@inheritDoc}
     */
    public function getDc()
    {
        return $this->dc;
    }

    /**
     * {@inheritDoc}
     */
    public function setDc($name)
    {
        $this->dc = $name;
    }
}
