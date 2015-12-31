<?php

class RobotsNoindexCMSExtensions extends DataExtension
{

    public function MetaTags(&$tags)
    {
        if (Director::isDev() or Director::isTest()) {
            $tags .= '<meta name="robots" content="noindex, nofollow" />';
        }
        return $tags;
    }
}
