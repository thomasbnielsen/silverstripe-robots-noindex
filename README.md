This module adds a robots metatag to discourage well-behaved search engine spiders from crawling and indexing your site.

The module will automatically add the tag when your site is in dev or test mode.  It can also be activated regardless of the site mode with the addition of an environment variable called 'SEO_PREVENT_INDEXING' which can be set to true.

For example, if you are using a .env file, you would add the following line to enable the module:

`SEO_PREVENT_INDEXING = true` 

A warning is shown in the CMS when the module is active and indexing is discouraged.

 
