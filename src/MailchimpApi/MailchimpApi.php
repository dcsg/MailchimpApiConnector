<?php

/**
 * This file is part of the MailchimpApi package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license    MIT License
 */

namespace MailchimpApi;

/**
 * Class MailchimpApi
 * @package MailchimpApi
 * @description Class to use the Mailchimp API <http://apidocs.mailchimp.com/api/>
 * @author Daniel Gomes <me@danielcsgomes.com>
 */
class MailchimpApi extends AbstractMailchimpApi implements MailchimpApiInterface
{
    const API_URL = 'https://%s.api.mailchimp.com/%0.1f/%s';
    /**
     * {@inheritdoc}
     */
    protected $apiVersion = 2.0;

    /**
     * {@inheritdoc}
     */
    public function call($method, array $params = array(), $format = self::FORMAT_JSON)
    {
        if ($this->apiVersion < 2.0) {
            return $this->getAdapter()->getContent(
                $this->getUrlToOldApi($method, $params, $format)
            );
        }

        $content = array_merge(
            $params,
            array(
                 'apikey' => $this->getApiKey(),
                 'method' => "{$method}.{$format}",
            )
        );

        return $this->getAdapter()->postContent(
            $this->getUrl($method),
            array(),
            json_encode($content)
        );
    }

    /**
     * Gets the url for Mailchimp API version < 2.0
     *
     * @param $method
     * @param array $params
     * @param $format
     *
     * @return string
     */
    private function getUrlToOldApi($method, array $params, $format)
    {
        $queryString = sprintf(
            '?apikey=%s&format=%s&method=%s%s',
            $this->getApiKey(),
            $format,
            $method,
            $this->paramsQueryStringBuilder($params)
        );

        return sprintf(
            $this::API_URL,
            $this->getDc(),
            $this->getApiVersion(),
            $queryString
        );
    }

    /**
     * {@inheritdoc}
     */
    public function paramsQueryStringBuilder(array $params)
    {
        return '&' . http_build_query($params);
    }

    /**
     * Gets the url for Mailchimp API version >= 2.0
     *
     * @param string $method
     *
     * @return string
     */
    private function getUrl($method)
    {
        return sprintf(
            $this::API_URL,
            $this->getDc(),
            $this->getApiVersion(),
            $method
        );
    }
}
