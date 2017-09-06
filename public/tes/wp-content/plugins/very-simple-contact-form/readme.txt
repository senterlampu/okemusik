=== Very Simple Contact Form ===
Contributors: Guido07111975
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=donation%40guidovanderleest%2enl
Version: 5.7
License: GNU General Public License v3 or later
License URI: http://www.gnu.org/licenses/gpl-3.0.html
Requires at least: 3.7
Tested up to: 4.6
Stable tag: trunk
Tags: simple, responsive, contact, form, email, honeypot, captcha, widget, sidebar


This is a very simple contact form. Use shortcode [contact] to display form on page or use the widget.


== Description ==
= About =
This is a very simple responsive translatable contact form. 

It only contains Name, Email, Subject and Message. And a simple captcha sum. 

Use shortcode `[contact]` to display form on page or use the widget to display form in sidebar.

For more info please take a look at the Installation section.

= List form submissions in dashboard =
With plugin [Contact Form DB](https://wordpress.org/plugins/contact-form-7-to-database-extension) you can list form submissions in your dashboard.

= Question? = 
Please take a look at the Installation and FAQ section.

= Translation =
Not included but plugin supports WordPress language packs.

More [translations](https://translate.wordpress.org/projects/wp-plugins/very-simple-contact-form) are very welcome!

= Credits =
Without the WordPress codex and help from the WordPress community I was not able to develop this plugin, so: thank you!

And I would like to thank the users of 'PHP hulp' for helping me creating bugfree code.

Enjoy!


== Installation ==
= How to use =
After installation add shortcode `[contact]` on your page to display form. 

Or go to Appearance > Widgets and add the widget to your sidebar.

By default messages will be send to email from admin (set in Settings > General).

While adding the shortcode or the widget you can add several attributes to personalize your form.

While adding the widget you can add some additional information above your form.

= Shortcode attributes = 
* Change email from admin: `[contact email_to="your-email-here"]`
* Multiple email: `[contact email_to="first-email-here, second-email-here"]`

You can also change message text or label text using an attribute.

* Label attributes: label_name, label_email, label_subject, label_captcha, label_message, label_submit
* Label error attributes: error_name, error_email, error_subject, error_captcha, error_message
* Error and success message attributes: message_error, message_success

= Examples =
* Change Name and Submit labels: `[contact label_name="Your Name" label_submit="Send"]`
* Change captcha label: `[contact label_captcha="Please enter %s"]`
* Change captcha label: `[contact label_captcha="Please enter %s here"]`

= Subject field =
* Hide field: `[contact hide_subject="true"]`

= Widget attributes =
The widget supports the same attributes.

= Examples =
* Change email from admin: `email_to="your-email-here"`
* Multiple email: `email_to="first-email-here, second-email-here"`
* Change Name and Submit labels: `label_name="Your Name" label_submit="Send"`
* Change captcha label: `label_captcha="Please enter %s"`
* Change captcha label: `label_captcha="Please enter %s here"`
* Hide subject field: `hide_subject="true"`


== Frequently Asked Questions ==
= How do I set plugin language? =
Plugin uses the WP Dashboard language, set in Settings > General.

If plugin language pack is not available, language fallback will be English.

= How do I add attributes? =
You can find more info about this at the Installation section.

= How do I style my form? =
Form will use theme styling for input fields and submit button (if available).

You can change style (CSS) using for example the [Very Simple Custom Style](https://wordpress.org/plugins/very-simple-custom-style) plugin.

= Can I hide Subject field? =
You can find more info about this at the Installation section.

= Can I add html in Message field? =
No, html tags are removed and the content of the message (send to admin) is text/plain.

= Can I use multiple shortcodes? =
Do not use multiple shortcodes on the same website. This might cause a conflict. 

But you can use the shortcode on a page and the widget on the same website.

= Are form submissions listed in my dashboard? =
No, they will be send to admin by mail only.

With plugin [Contact Form DB](https://wordpress.org/plugins/contact-form-7-to-database-extension) you can list form submissions in your dashboard.

= Why am I not receiving messages? =
* Look also in your junk/spam folder.
* Check the Installation section and check shortcode for mistakes.
* Install another contactform plugin (such as Contact Form 7) to determine if it's caused by my plugin or something else.
* Messages are send using the wp_mail function (similar to php mail function). Maybe your hostingprovider disabled the php mail function, ask them to enable it. 

= Why does the captcha number not display properly? =
The captcha (random number) uses a php session to temporary store the number and some hostingproviders have disabled the use of sessions. Ask them for more info about this.

= Does this plugin has anti-spam features? =
Of course, the default WordPress sanitization and escaping functions are included.

It also contains 2 (invisible) honeypot fields (firstname and lastname) and a simple captcha sum.

= How can I make a donation? =
You like my plugin and you're willing to make a donation? Nice! There's a PayPal donate link on the WordPress plugin page and my website.

= Other question or comment? =
Please open a topic in plugin forum.


== Changelog ==
= Version 5.7 =
* added shortcode attribute to hide subject field
* file vscf-style: minor changes

= Version 5.6 =
* updated files vscf-form and vscf-widget-form (css class of input fields)

= Version 5.5 =
* readme file: bunch of textual changes

= Version 5.4 =
* added file changelog
* updated readme file

For all versions please check file changelog.


== Screenshots == 
1. Very Simple Contact Form (Twenty Sixteen theme).
2. Very Simple Contact Form (Twenty Sixteen theme).
3. Very Simple Contact Form widget (Twenty Sixteen theme).
4. Very Simple Contact Form widget (dashboard).