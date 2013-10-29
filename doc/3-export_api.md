# Usage of the Mailchimp Export API v1.0

## Simple example of exporting the list members

```php

<?php

require_once __DIR__ . '/../vendor/autoload.php';

use MailchimpApiConnector\HttpAdapter\BuzzHttpAdapter;
use MailchimpApiConnector\MailchimpExportApi;

$adapter = new BuzzHttpAdapter();
$mailchimpExportApi = new MailchimpExportApi($adapter, 'YOUR-API-KEY');

$response = $this->mailchimpExportApi->call('list', array("id" => 'YOUR-LIST-ID'));

print_r($response);

```

Back to [index](index.md)
