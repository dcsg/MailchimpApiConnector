 Mailchimp Abstract API Connector v1.0.0
========================================

[![Build Status](https://travis-ci.org/danielcsgomes/MailchimpApi.png?branch=master)](https://travis-ci.org/danielcsgomes/MailchimpApi) [![Scrutinizer Quality Score](https://scrutinizer-ci.com/g/danielcsgomes/MailchimpApi/badges/quality-score.png?s=435ce0fae0b07d7c445af8f67125f537c10f20e5)](https://scrutinizer-ci.com/g/danielcsgomes/MailchimpApi/) [![Code Coverage](https://scrutinizer-ci.com/g/danielcsgomes/MailchimpApi/badges/coverage.png?s=9aba2cb57afa875a6f7006f2bfbdb856ab3135a2)](https://scrutinizer-ci.com/g/danielcsgomes/MailchimpApi/)

**Mailchimp Abstract API Connector** is a PHP 5.3+ library that allow you to connect in an abstract and simple way to the **Mailchimp API** and **Mailchimp Export API**.

**Disclaimer:** This library is not a wrapper of [**Mailchimp API**](http://apidocs.mailchimp.com/). Also this is a WIP library.


### Instalation

#### Composer

```json
"require": {
    ...
    "danielcsgomes/mailchimpapi": "1.0.*@dev"
}
```

### Usage

#### 1. [Mailchimp API](http://apidocs.mailchimp.com/api/)

Example using [**listActivity** method](http://apidocs.mailchimp.com/api/1.3/listactivity.func.php) with [Buzz Library](https://github.com/kriswallsmith/Buzz).

```php
<?php

use MailchimpApi\HttpAdapter\BuzzHttpAdapter;
use MailchimpApi\MailchimpApi;

$mailchimp = new MailchimpApi(new BuzzHttpAdapter(), 'YOUR MAILCHIMP API KEY');

$mailchimp->setApiVersion(1.3); // Set the API version

$params = array(
    'id' => 'YOUR MAILCHIMP LIST ID'
    // ... other parameters needed for the method
);

echo $mailchimp->call('listActivity', $params, MailchimpApi::FORMAT_JSON);
```

#### 2. [Mailchimp Export API](http://apidocs.mailchimp.com/export/)

Example using [**list** method](http://apidocs.mailchimp.com/export/1.0/list.func.php) with [Buzz Library](https://github.com/kriswallsmith/Buzz).

```php
<?php

use MailchimpApi\HttpAdapter\BuzzHttpAdapter;
use MailchimpApi\MailchimpExportApi;

$mailchimp = new MailchimpExportApi(new BuzzHttpAdapter(), 'YOUR MAILCHIMP API KEY');

$mailchimp->setApiVersion(1.0); // Set the API version

$params = array(
    'id' => 'YOUR MAILCHIMP LIST ID'
);

echo $mailchimp->call('list', $params);
```

### TODO

* Better handling of the HTTP response.
* Implement the API calls via HTTP POST method.
* Implement OAuth2.


### Credits

* [Daniel Gomes](me@danielcsgomes.com)
* HTTP Adapters are part of [Geocoder](https://github.com/willdurand/Geocoder) Library

### License

**Mailchimp Abstract API Connector** is released under the MIT License. See the bundled LICENSE file for details.
