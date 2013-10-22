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
    const API_URL = 'http://%s.api.mailchimp.com/%0.1f/?apikey=%s&format=%s&method=%s%s';
    /**
     * {@inheritdoc}
     */
    protected $apiVersion = 1.3;

    /**
     * {@inheritdoc}
     */
    public function call($method, array $params = array(), $format = self::FORMAT_JSON)
    {
        return $this->getAdapter()
            ->getContent(
                sprintf(
                    $this::API_URL,
                    $this->getDc(),
                    $this->getApiVersion(),
                    $this->getApiKey(),
                    $format,
                    $method,
                    $this->paramsQueryStringBuilder($params)
                )
            );
    }

    /**
     * {@inheritDoc}
     */
    public function paramsQueryStringBuilder(array $params)
    {
        return '&' . http_build_query($params);
    }
}
