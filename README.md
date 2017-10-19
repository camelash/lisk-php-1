# Lisk PHP Bundle
This package provides a PHP interface to the official Lisk API.

## Installation instructions
### Step 1: install using composer
```sh
composer require goforlisk/lisk-php-bundle
```

### Step 2: add package to AppKernel.php
```php
<?php
// app/AppKernel.php

public function registerBundles()
{
    $bundles = array(
        // ...
        new LiskPhpBundle\LiskPhpBundle(),
    );
}
```

### Step 3: Configure the API base URL and Network hash
Add the following to your app/config.yml

```yaml
# Lisk PHP configuration
lisk_php:
    base_url: 'https://login.lisk.io'
    network_hash: 'ed14889723f24ecc54871d058d98ce91ff2f973192075c0155ba2b7b70ad2511'
```

Or specify another Lisk API node by changing the `base_url`.
The network hashed shown above refers to the mainnet, if you wish to use the testnet, enter `da3ed6a45429278bac2666961289ca17ad86595d33b31037615d4b8e8f158bba` as `network_hash`

## What can I do with this bundle

This package provides a PHP interface to the official Lisk API. It exposes a Symfony service that allows for an easy integration of the Lisk API in your projects.

## Stability

This package can only be required in its `dev-master` version since development has just started and not all API functions have been implemented. Currently all API methods with PUT requesta are not implemented but will be added soon.

