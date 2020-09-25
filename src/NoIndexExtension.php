<?php

namespace NobrainerWeb\NoIndex;

use SilverStripe\Control\Director;
use SilverStripe\Core\Environment;
use SilverStripe\Core\Extension;
use SilverStripe\Forms\LiteralField;

class NoIndexExtension extends Extension
{

    public function MetaTags(&$tags)
    {
        if ($this->isActive()) {
            $tags .= '<meta name="robots" content="noindex, nofollow" />';
        }

        return $tags;
    }

    public function updateCMSFields($fields)
    {
        if (! $this->isActive()) {
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
    private function getWarningMessage() {
        $message = _t(self::class . '.NO_INDEX_WARNING', 'Warning: No indexing!');

        if (Director::isDev()) {
            $message .= '<br>'. _t(self::class . '.NO_INDEX_WARNING_DEV', 'This website is running in development mode, and is not being indexed by search engines');
            return $message;
        }

        if (Director::isTest()) {
            $message .= '<br>'. _t(self::class . '.NO_INDEX_WARNING_TEST', 'This website is running in test mode, and is not being indexed by search engines');
        }

        if (Environment::getEnv('SEO_PREVENT_INDEXING') === true) {
            $message .= '<br>'. _t(self::class . '.NO_INDEX_WARNING_ENV', 'Search engine indexing is disabled by an environment setting');
        }

        return $message;
    }

    /**
     * Decides whether the module should be enabled
     * @return bool
     */
    private function isActive() {
        return (Director::isDev() || Director::isTest() || (Environment::getEnv('SEO_PREVENT_INDEXING') === true));
    }
}
