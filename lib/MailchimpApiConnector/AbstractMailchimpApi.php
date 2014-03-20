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

namespace MailchimpApiConnector;

use MailchimpApiConnector\Exception\MailchimpApiException;
use MailchimpApiConnector\HttpAdapter\HttpAdapterInterface;

/**
 * Class AbstractMailchimpApi
 *
 * @package MailchimpApiConnector
 *
 * @author Daniel Gomes <me@danielcsgomes.com>
 */
abstract class AbstractMailchimpApi implements MailchimpApiInterface
{
    /**
     * @version
     */
    const VERSION = '2.2.1';

    /**
     * Possible Formats Constants
     */
    const FORMAT_JSON = 'json';
    const FORMAT_PHP = 'php';
    const FORMAT_XML = 'xml';
    const FORMAT_LOLCODE = 'lolcode';

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
     * {@inheritdoc}
     */
    public function getAdapter()
    {
        return $this->adapter;
    }

    /**
     * {@inheritdoc}
     */
    public function setAdapter(HttpAdapterInterface $adapter)
    {
        $this->adapter = $adapter;
    }

    /**
     * {@inheritdoc}
     */
    public function getApiKey()
    {
        return $this->apiKey;
    }

    /**
     * {@inheritdoc}
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
     * {@inheritdoc}
     */
    public function getApiVersion()
    {
        return $this->apiVersion;
    }

    /**
     * {@inheritdoc}
     */
    public function setApiVersion($version)
    {
        $this->apiVersion = $version;
    }

    /**
     * {@inheritdoc}
     */
    public function getDc()
    {
        return $this->dc;
    }

    /**
     * {@inheritdoc}
     */
    public function setDc($name)
    {
        $this->dc = $name;
    }
}
