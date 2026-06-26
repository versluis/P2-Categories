# P2 Categories — Changelog

## v1.9 — June 2026

PHP modernisation:

- Replaced PHP4-style `var` with `public` on all `P2` class properties (`functions.php`)
- Replaced `array( &$this, ... )` with `array( $this, ... )` — PHP4 by-reference passing is invalid in PHP 8 (`functions.php`)
- Replaced `add_filter()` with `add_action()` for the `after_setup_theme` hook (`functions.php`)
- Replaced `@str_split()` calls with explicit `strpos()` false-checks and `substr()`; removes error-suppression operator and fixes the underlying assumption that `strpos()` always finds a match (`functions.php`)
- Initialised `$tag_links` and `$cat_links` before their `foreach` loops to prevent undefined variable notices (`functions.php`, `functions-p2-categories.php`)

---

## v1.8 — June 2026

Deprecated WordPress API replacements:

- Replaced `query_posts()` with `WP_Query` and added `wp_reset_postdata()` in `get_latest_posts()` (`inc/ajax-read.php`)
- Replaced `get_category_by_slug()` (deprecated WP 5.9) with `get_term_by('slug', ...)` (`inc/ajax.php`)
- Replaced manual `<title>` tag and `wp_title` filter (deprecated WP 4.4) with `add_theme_support('title-tag')`; removed `p2_wp_title()` function (`functions.php`, `header.php`)
- Replaced `global $user_ID` (deprecated WP 3.5) with `get_current_user_id()` across `functions.php`, `inc/ajax.php`, `inc/ajax-read.php`, and `inc/template-tags.php`
- Replaced nested `get_tag_name()` function declaration with `wp_list_pluck()` (`inc/ajax.php`)

---

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
