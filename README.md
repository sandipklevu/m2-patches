# Patch for recipe module to be display in the Quick search and Search Result page
Override Product model file

## Installation

```bash
composer require sandipklevu/module-searchforreceipe
php bin/magento setup:upgrade
php bin/magento setup:di:compile 
php bin/magento setup:static-content:deploy -s standard
```
