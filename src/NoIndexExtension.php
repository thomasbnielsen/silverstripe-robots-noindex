<?php

namespace NobrainerWeb\NoIndex;

use SilverStripe\Control\Director;
use SilverStripe\Core\Extension;
use SilverStripe\Forms\LiteralField;

class NoIndexExtension extends Extension
{

    public function MetaTags(&$tags)
    {
        if (Director::isDev() || Director::isTest()) {
            $tags .= '<meta name="robots" content="noindex, nofollow" />';
        }

        return $tags;
    }

    public function updateCMSFields($fields)
    {
        $fields->addFieldToTab('Root.Main', LiteralField::create(
            'NoIndexWarningHeader',
            '<div class="alert alert-warning">' . _t(
                self::class . '.NO_INDEX_WARNING',
                "Warning: No indexing! This website is running in development mode, and is not being indexed by search engines"
            )
            . '</div>'
        ), 'Title');
    }

}
