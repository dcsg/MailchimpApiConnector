# Usage of the Mailchimp API v2.0

#### Simple example to retrieve listActivity

```php

<?php

require_once __DIR__ . '/../vendor/autoload.php';

use MailchimpApi\HttpAdapter\BuzzHttpAdapter;
use MailchimpApi\MailchimpApi;

$adapter = new BuzzHttpAdapter();
$mailchimp = new MailchimpApi($adapter, 'YOUR-API-KEY');
// No need to set the API version since the default is 2.0

$response = $mailchimp->call('/lists/activity', array('id' => 'YOUR-LIST-ID'));

print_r($response);

```

# Usage of the Mailchimp API v1.x

#### Simple example to retrieve listActivity

```php

<?php

require_once __DIR__ . '/../vendor/autoload.php';

use MailchimpApi\HttpAdapter\BuzzHttpAdapter;
use MailchimpApi\MailchimpApi;

$adapter = new BuzzHttpAdapter();
$mailchimp = new MailchimpApi($adapter, 'YOUR-API-KEY');
$mailchimp->setApiVersion(1.3);

$response = $mailchimp->call('listActivity', array('id' => 'YOUR-LIST-ID'));

print_r($response);

```

Back to [index](index.md)
