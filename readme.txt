=== Language Taxonomy ===
Contributors: dominik.schwind
Tags: language, taxonomy
Requires at least: 3.0
Tested up to: 6.8.3
Stable tag: 0.3.0

Adds a language taxonomy to posts, pages and other items.

== Description ==

Adds a language taxonomy to posts, pages and other items.

This will add a URL scheme (Your Blog)/lang/(slug).

There is also a template tag for usage within the loop.

---

Example:

`<?php if(function_exists('lt_the_language')): ?>
<?php lt_the_language($post_id); ?>
<?php endif; ?>`

== Installation ==

1. Just like any other plugin, too.
1. Activate it.
1. Update your "Permalinks" settings.

== Screenshots ==
1. New language box in the New Post screen.
2. Overview of the languages
3. Test language with permalink - English
4. Test language with permalink - German

== Changelog ==

= 0.3.0 =

* Use the slug as a language in the ActivityPub plugin. As long as the slug is an ISO language code.

= 0.2.3 =

* Checked for 4.2 compatibility
* Added screenshots

= 0.2.2 =

* Checked for 3.9 compatibility.

= 0.2.1 =

* Removed two typos

= 0.2 =

* Template tag to use in the loop

= 0.1 =

* Initial Version
* More options will be coming, especially template tags.

== Upgrade Notice ==

= 0.2 =
This update introduces the template tag.