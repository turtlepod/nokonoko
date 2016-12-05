# Tamatebako Box

WordPress theme engine for faster theme development.

**Copyright & license**<br />
This framework is licensed under the [GNU General Public License](http://www.gnu.org/licenses/old-licenses/gpl-2.0.html), version 2 (GPL) or later.<br />
2016 © [Genbu Media](http://genbumedia.com/). All rights reserved.

###Changelog

**3.4.0 - 05.Dec.2016**

* Remove Custom CSS Module. No longer needed in WP.4.7.

**3.3.4 - 12.Nov.2016**

* Prefix custom css module to "tmb_custom_css" for compat issue with 4.7.
* Example to back-compat custom css in 4.7.

**3.3.3 - 24.Sept.2016**

* Move tamatebako_parse_css() as tamatebako_esc_css()
* Better handling of front page template.

**3.3.2 - 27.July.2016**

* Improvement in menu falback cb. 

**3.3.1 - 19.July.2016**

* use wp_strip_all_tags() to sanitize CSS in custom css & custom fonts module.
* use tamatebako_parse_css() as sanitize cb custom css module. this because wp_strip_all_tags() remove line breaks in textarea.
* remove activation redirect in upsell module. It's not allowed in wp.org

**3.3.0 - 18.May.2016**

* Remove Logo Module. Use WP Custom Logo
* Remove Customizer Mobile View Module. WP already have it.
* Remove Get the Image (NokoNoko).
* Use import for base CSS (NokoNoko).
* No longer use genericons. create own "esicons".
* Selective widget refresh (customizer) support.
* Add f(x) Updater.
* Add Customizer Control: Radio Image and use it for layout.

**3.2.0 - 20.Mar.2016**

* Upsell Module (for PRO version).
* Responsive image in content.
* Hide Page Title Module

**3.1.9 - 05.Mar.2016**

* Comment moderation now using template tag and not filter to avoid error.

**3.1.8 - 14.Feb.2016**

* Add Font Weight Option in Fonts module.

**3.1.7 - 09.Feb.2016**

* Esc Attr Theme Name

**3.1.6 - 06.Feb.2016**

* Add filter for aside infinity.

**3.1.5 - 04.Feb.2016**

* Edit post link wrap.

**3.1.4 - 26.Jan.2016**

* Add nonce to custom font editor style.
* Prefix theme_mod for custom font (in nokonoko)

**3.1.3 - 08.Jan.2016**

* Fix child theme style.css to parent theme style.css deps.

**3.1.2 - 14.Dec.2015**

* Fix child theme style.css to parent theme style.css deps.

**3.1.1 - 05.Sep.2015**

* add comment in moderation text notice.

**3.1.0 - 19.Aug.2015**

* merge context to setup.
* merge all wp_head stuff. 
* deprecate tamatebako_check_js_script() add it in wp_head.
* remove array_unique in body class and post class.
* merge accessibility template tags to general.
* back compat: minimum using wp.4.1 (since the "title-tag" theme support.)
* add args to set logo theme mod name. change theme mod name to "theme-logo".
* remove scripts modules + rethink css files.
* various stuff happen :(

**3.0.1 - 11.Aug.2015**

* remove echo in check js script.
* fix entry taxonomy
* remove blog page content as archive description.
* entry-taxonomy class fix.

**3.0.0 - 10.Aug.2015**

* first stable standalone library.