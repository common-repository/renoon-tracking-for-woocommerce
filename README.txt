== Renoon Tracking for Woocommerce ==
Contributors: renoon,wpconcierges
Tags: renoon, renoon tracking
Requires at least: 3.1
Tested up to: 5.9
Stable tag: 1.1.4
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

This plugin is for renoon merchants to track sales coming from the renoon marketplace. 

== Description ==

Use this Plugin to post order data from your woocommerce store to any url.  This fires when the Woocommerce Thank You hook is called and when an order status changes from pending to processing.  This works with the woocommerce subscription products, variations, and simple products.   It takes all of the Order Meta Data along with the Order Items 
and POSTs/GETs them to the url of your choice.  They are passed in the configuration that you setup.  The available from Woocommerce are showing in the documentation.  So for example: you need to pass the amount you would then place "amount" in the key and "order_total" in the value.

This plugin is useful if you are needing to post your Woocommerce data to a third party script or service that does not have an integration into Woocommerce. Great for affiliate postbacks.

See documentation for more information

https://renoon.com/partners/woocommerce-plugin

== Installation ==

1. Upload 'renoon-tracking' to the '/wp-content/plugins/' directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Go to *Tools > Renoon Tracking*
4. Enter your Renoon Merchant Id. Provided by your Renoon representative


== Frequently Asked Questions ==
= How can I get support for this plugin
Reach out to the team at www.renoon.com 
Check out the documentation at https://renoon.com/partners/woocommerce-plugin

== Screenshots ==



== Changelog ==
= 1.1.4 =
-fixed sanitization

= 1.1.1 =
-added cookie domain and cookie path from wp

= 1.1.0 =
-fixed curren issue 
-optimized code for getting fields


= 1.0.9 =
-fixed sort over 10 fields

= 1.0.6 =
-added logging to woocommerce system logs, 
-fixed bug adding after key values on edit

= 1.0.5 =
-fixed bug with key value pairs

= 1.0.2 =
-Made it be able to do multiple postbacks in one call.

= 1.0.0 =
-Initial Release.