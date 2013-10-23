<?php

namespace MailchimpApi\Tests;

use MailchimpApi\HttpAdapter\CurlHttpAdapter;
use MailchimpApi\MailchimpApi;

/**
 * Class MailchimpApiTest
 * @package MailchimpApi\Tests
 * @author Daniel Gomes <me@danielcsgomes.com>
 */
class MailchimpApiTest extends TestCase
{

    /**
     * @var \MailchimpApi\MailchimpApi
     */
    protected $mailchimpApi;

    public function setUp()
    {
        $this->mailchimpApi = new MailchimpApi($this->getMockAdapter(), 'api_key');
    }

    /**
     * @expectedException \MailchimpApi\Exception\MailchimpApiException
     */
    public function testSetANullOrEmptyApiKey()
    {
        $this->mailchimpApi->setApiKey(''); // Test with empty string
        $this->mailchimpApi->setApiKey(null); // Test with empty string
    }

    public function testCallApi()
    {
        $this->mailchimpApi->setApiKey('api_key');
        $response = $this->mailchimpApi->call("listActivity", array(""));
        $this->assertEquals('string', gettype($response));
        $this->assertGreaterThan(0, strlen($response));

    }

    public function testCallOldApi()
    {
        $this->mailchimpApi->setApiKey('api_key');
        $this->mailchimpApi->setApiVersion(1.3);
        $response = $this->mailchimpApi->call("listActivity", array(""));
        $this->assertEquals('string', gettype($response));
        $this->assertGreaterThan(0, strlen($response));

    }

    public function testCallOldApiWithRealData()
    {
        $this->verifyApiKeyAndListId();
        $this->verifyCurlExtension();

        $this->mailchimpApi->setAdapter(new CurlHttpAdapter());
        $this->mailchimpApi->setApiKey($_SERVER['MAILCHIMP_API_KEY']);
        $this->mailchimpApi->setApiVersion(1.3);

        $params = array(
            "id" => $_SERVER['MAILCHIMP_LIST_ID']
        );
        $response = $this->mailchimpApi->call('listActivity', $params);
        $this->assertGreaterThan(0, strlen($response));
        $this->assertNotContains('error', $response);
    }

    public function testCallApiWithRealData()
    {
        $this->verifyApiKeyAndListId();
        $this->verifyCurlExtension();

        $this->mailchimpApi->setAdapter(new CurlHttpAdapter());
        $this->mailchimpApi->setApiKey($_SERVER['MAILCHIMP_API_KEY']);

        $params = array(
            "id" => $_SERVER['MAILCHIMP_LIST_ID']
        );

        $response = $this->mailchimpApi->call('lists/activity', $params);
        $this->assertGreaterThan(0, strlen($response));
        $this->assertNotContains('error', $response);
    }

    public function testCallApiWithRealDataAndWithWrongMethod()
    {
        $this->verifyApiKeyAndListId();
        $this->verifyCurlExtension();

        $this->mailchimpApi->setAdapter(new CurlHttpAdapter());
        $this->mailchimpApi->setApiKey($_SERVER['MAILCHIMP_API_KEY']);
        $this->mailchimpApi->setApiVersion(2.0);

        $params = array(
            "id" => $_SERVER['MAILCHIMP_LIST_ID']
        );

        $response = $this->mailchimpApi->call('invalid_method', $params);
        $this->assertGreaterThan(0, strlen($response));
        $this->assertContains('error', $response);
    }

    private function verifyApiKeyAndListId()
    {
        if (!isset($_SERVER['MAILCHIMP_API_KEY'])) {
            $this->markTestSkipped('You need to configure the MAILCHIMP_API_KEY value in phpunit.xml');
        }

        if (!isset($_SERVER['MAILCHIMP_LIST_ID'])) {
            $this->markTestSkipped('You need to configure the MAILCHIMP_LIST_ID value in phpunit.xml');
        }
    }

    private function verifyCurlExtension()
    {
        if (!function_exists('curl_init')) {
            throw new ExtensionNotLoadedException('cURL has to be enabled.');
        }
    }
}
