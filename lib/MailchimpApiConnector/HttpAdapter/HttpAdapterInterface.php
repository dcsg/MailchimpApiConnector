<?php

/**
 * This file is part of the MailchimpApiConnector package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license    MIT License
 */

namespace MailchimpApiConnector\HttpAdapter;

/**
 * @author William Durand <william.durand1@gmail.com>
 */
interface HttpAdapterInterface
{
    /**
     * Returns the content fetched from a given URL.
     *
     * @param string $url
     *
     * @return string
     */
    public function getContent($url);

    /**
     * @param string $url
     * @param array  $headers HTTP headers
     * @param string $content Content to be sent
     *
     * @return string
     */
    public function postContent($url, $headers = array(), $content = '');

    /**
     * Returns the name of the HTTP Adapter.
     *
     * @return string
     */
    public function getName();
}
