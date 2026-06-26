# P2 Categories — Changelog

## v1.7 — June 2026

Security fixes:

- Fixed SQL injection risk in `tag_search()`: replaced deprecated `$wpdb->escape()` and raw string concatenation with `$wpdb->prepare()` (`inc/ajax-read.php`)
- Fixed XSS vulnerability in comment reply link: `$comment->comment_ID` and `$post->ID` were embedded in an `onclick` attribute without `esc_js()` (`functions.php`)
- Sanitized `$_POST['citation']` and `$_POST['post_citation']` with `wp_kses_post()` before saving to post content (`inc/ajax.php`)
- Sanitized `$_POST['drop_cat']` with `sanitize_key()` and added `isset()` guard before use (`inc/ajax.php`)
- Replaced `extract($args, EXTR_SKIP)` with explicit variable assignments in `prologue_get_comment_reply_link()` to prevent scope pollution (`functions.php`)

---

## v1.6 — May 2018

- Complete re-write; rebuilt P2 Categories from notes, based on P2 v1.5.8 (2016)
- Fixed the category drop down menu
- Fixed a bug that did not display the number of posts in more than one category
- Updated a call to a deprecated WordPress function `wp_get_current_user()`
- Fixed several PHP 7 deprecation warnings
- Updated class constructors to use `__construct()` methods
- Hunted down undocumented features and documented them
- Added this changelog file

---

## v1.5 — sometime in 2013

- Unreleased beta version

---

## v1.4 — October 2013

- Removed category display from archive pages
- Categories are not shown if posts are in "Uncategorized"
- Added post count to category meta display (just like P2 tags)
- Turned project back into a full fork; it is no longer a child theme (category posting didn't work as a child theme)
- Can be used with other P2 child themes, such as P2 Responsive

---

## v1.3

- Unreleased beta version

---

## v1.2

- Turned project into a child theme

---

## v1.1

- Added dropdown menu for category selection (thanks to Nobble)
- Display categories in each post
- Added Category Archives page
- Fixed "broken menu in Firefox" when using a custom header (thanks to lagerassasin)
- Minor CSS improvements for `<pre>` tags and search submit button
- Added P2 Turkish translation (thanks to erayaydin)
- Added Brazilian Portuguese translation (thanks to Eduardo Zulian)

---

## v1.0

- Initial release, based on P2 1.5.1
- Added support for posting into categories, as it was in P2 1.3.3
