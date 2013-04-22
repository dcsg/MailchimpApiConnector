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
 * Class MailchimpApiInterface
 * @package MailchimpApi
 * @author Daniel Gomes <me@danielcsgomes.com>
 */
interface MailchimpApiInterface
{
    /**
     * Calls Mailchimp API
     * @param string $method
     * @param array $params
     * @param string $format
     * @return string Response content
     */
    public function call($method, array $params = array(), $format = '');

    /**
     * Gets API key
     * @return  string
     */
    public function getApiKey();

    /**
     * Gets API version
     * @return float
     */
    public function getApiVersion();

    /**
     * Gets DC
     * @return  string
     */
    public function getDc();

    /**
     * Builds the query string for the API request parameters
     * @param   array $params
     * @return  string URL encoded string
     * @return  null
     */
    public function paramsQueryStringBuilder(array $params);

    /**
     * Sets API key
     * @param   string $key
     * @throws  MailchimpApiException
     * @return  null
     */
    public function setApiKey($key);

    /**
     * Sets API version
     * @param   float $version
     * @return  null
     */
    public function setApiVersion($version);

    /**
     * Sets DC
     * @param   string $name
     * @return  null
     */
    public function setDc($name);

    /**
     * Gets Adapter
     * @return HttpAdapterInterface
     */
    public function getAdapter();

    /**
     * Sets Adapter
     * @param HttpAdapterInterface $adapter
     * @return null
     */
    public function setAdapter(HttpAdapterInterface $adapter);
}
