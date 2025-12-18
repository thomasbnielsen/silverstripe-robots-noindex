<?php

namespace NobrainerWeb\NoIndex;

use SilverStripe\Control\Director;
use SilverStripe\Core\Config\Configurable;
use SilverStripe\Core\Environment;
use SilverStripe\Core\Extension;
use SilverStripe\Forms\LiteralField;

class NoIndexExtension extends Extension
{
    use Configurable;

    private static $no_index_domains;

    public function MetaTags(&$tags)
    {
        if ($this->preventIndexing()) {
            $tags .= '
<meta name="robots" content="noindex, nofollow" />';
        }

        return $tags;
    }

    public function updateCMSFields($fields)
    {
        if (!$this->preventIndexing()) {
            return;
        }
        $fields->unshift(LiteralField::create(
            'NoIndexWarningHeader',
            '<div class="alert alert-warning">' . $this->getWarningMessage() . '</div>'
        ));
    }

    /**
     * Returns a warning message based on the current configuration of the site
     * @return string
     */
    private function getWarningMessage()
    {
        if ($this->isOnDevDomain()) {
            return _t(self::class . '.NO_INDEX_WARNING_DEV_SERVER', 'Warning: no indexing! Search engine indexing disabled as we are on a dev domain');
        }

        if (Director::isDev()) {
            return _t(self::class . '.NO_INDEX_WARNING_DEV', 'Warning: no indexing! This website is running in dev mode, and is not being indexed by search engines');
        }

        if (Director::isTest()) {
            return _t(self::class . '.NO_INDEX_WARNING_TEST', 'Warning: no indexing! This website is running in test mode, and is not being indexed by search engines');
        }

        if (Environment::getEnv('SEO_PREVENT_INDEXING') === true) {
            return _t(self::class . '.NO_INDEX_WARNING_ENV', 'Warning: no indexing! Search engine indexing disabled by an environment setting');
        }

        return null;
    }

    /**
     * Decides whether the module should prevent indexing
     * @return bool
     */
    private function preventIndexing()
    {
        if ($this->isOnDevDomain()) {
            return true;
        }

        return (Director::isDev() || Director::isTest() || (Environment::getEnv('SEO_PREVENT_INDEXING') === true));
    }

    private function isOnDevDomain()
    {
        $http_host = $_SERVER['HTTP_HOST'];
        $dev_servers = NoIndexExtension::config()->get('no_index_domains');
        if ($dev_servers) {
            foreach ($dev_servers as $server) {
                if (str_ends_with($http_host, $server)) {
                    return true;
                }
            }
        }
        return false;
    }
}
