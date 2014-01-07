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
