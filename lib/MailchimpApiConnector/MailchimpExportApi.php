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

/**
 * Class to use the Mailchimp Export API <http://apidocs.mailchimp.com/export/>
 * @package MailchimpApiConnector
 *
 * @author Daniel Gomes <me@danielcsgomes.com>
 */
class MailchimpExportApi extends AbstractMailchimpApi implements MailchimpApiInterface
{
    const API_URL = 'http://%s.api.mailchimp.com/export/%0.1f/%s?&apikey=%s%s';
    /**
     * {@inheritdoc}
     */
    protected $apiVersion = 1.0;

    /**
     * {@inheritdoc}
     */
    public function call($method, array $params = array(), $format = self::FORMAT_JSON)
    {
        return $this->getAdapter()->getContent(
            sprintf(
                $this::API_URL,
                $this->getDc(),
                $this->getApiVersion(),
                $method,
                $this->getApiKey(),
                $this->paramsQueryStringBuilder($params)
            )
        );
    }

    /**
     * {@inheritdoc}
     */
    public function paramsQueryStringBuilder(array $params)
    {
        $paramsString = "";
        foreach ($params as $key => $value) {
            if (is_array($value)) {
                $value = http_build_query($value);
            }
            $paramsString .= "&$key=$value";
        }

        return $paramsString;
    }
}
