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

use Buzz\Browser;

/**
 * @author William Durand <william.durand1@gmail.com>
 */
class BuzzHttpAdapter implements HttpAdapterInterface
{
    /**
     * @var Browser
     */
    protected $browser;

    /**
     * @param Browser $browser
     * @param Boolean $verifypeer
     */
    public function __construct(Browser $browser = null, $verifypeer = true)
    {
        $this->browser = null === $browser ? new Browser() : $browser;
        $this->browser->getClient()->setVerifyPeer($verifypeer);
    }

    /**
     * {@inheritdoc}
     */
    public function getContent($url)
    {
        try {
            $response = $this->browser->get($url);
            $content  = $response->getContent();
        } catch (\Exception $e) {
            $content = null;
        }

        return $content;
    }

    /**
     * {@inheritdoc}
     */
    public function postContent($url, $headers = array(), $content = '')
    {
        try {
            $response = $this->browser->post($url, $headers, $content);
            $content = $response->getContent();
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
        return 'buzz';
    }
}
