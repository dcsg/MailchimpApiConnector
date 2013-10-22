<?php

/**
 * This file is part of the Geocoder package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license    MIT License
 */

namespace MailchimpApi\HttpAdapter;

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
     * @param Browser $browser Browser object
     */
    public function __construct(Browser $browser = null)
    {
        $this->browser = null === $browser ? new Browser() : $browser;
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
