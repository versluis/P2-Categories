# P2 Categories — Changelog

## v2.1 — June 2026

Dark mode:

- Added full dark colour palette to `style.css` via `html.dark-mode` selectors covering all colour declarations: backgrounds, text, links, borders, inputs, buttons, blockquotes, autocomplete dropdowns, tooltips, navigation menus, post-format UI, tables, widgets, and sticky posts
- Accent colour lightened from `#3478e3` to `#5a9af0` for legibility on dark backgrounds; hover colour adjusted to `#f08050`
- Sidebar column tint switched from a background image (`sidebar_back.gif`) to a plain CSS background colour — no new image asset required
- Added user-facing **☾ Dark mode / ☀ Light mode** toggle button in the site header; preference is saved to `localStorage` and persists across sessions (`js/dark-mode.js`, `header.php`, `inc/js.php`)
- A tiny inline script in `<head>` applies the `dark-mode` class to `<html>` before first paint, preventing any flash of the wrong colour scheme
- OS-level preference changes are detected live via `matchMedia` and applied automatically when no manual preference is stored
- ☾ and ☀ icons added to the toggle button labels for clarity across languages (Unicode symbols U+263E and U+2600, not emoji — render as text glyphs on all platforms)

Category pill selector:

- Replaced the raw `<select>` category dropdown in `post-form.php` with clickable category pills styled to match the existing post-format tab row (`#post-types`)
- Each pill uses the same border, radius, background, and `:active` press effect as the format tabs; `No Category` pill is pre-selected as the default
- Selection updates a `<input type="hidden" name="drop_cat">` via a small jQuery click handler, so the form submission behaviour is unchanged
- Full dark mode support via `html.dark-mode #cat-types` overrides matching the dark-mode `#post-types` palette
- Fixed missing `esc_attr()` / `esc_html()` on category slug and name output

Drop local jQuery UI Autocomplete:

- Removed `js/jquery.ui.autocomplete.js` — WordPress already bundles `jquery-ui-autocomplete` and the three P2 extension scripts already declare it as a dependency by its WordPress handle name, so the local copy was loaded twice
- Removed dead `p2-user-bundle` script registration from `inc/js.php` — was registered but never enqueued
- Deleted `js/p2.user.bundle.js` (pre-built bundle file, now unused)
- Removed `jquery.ui.autocomplete.js` from `bin/bundle-user-js` file list
- Retained `js/jquery.ui.autocomplete.css` for autocomplete dropdown appearance styling

---

## v2.0 — June 2026

JavaScript modernisation (`/js`):

- Fixed `spinSmall` ordering bug in `p2.js`: the spin config object was declared after `commentEditSpinnerText` used it; due to `var` hoisting `spinSmall` was `undefined` when `.spin()` ran — moved declaration above its first use
- Removed duplicate `var commentEditSpinnerText` declaration; collapsed into a single statement (`js/p2.js`)
- Replaced `.bind()` with `.on()` in three places — `.bind()` was deprecated in jQuery 3.0 (`js/p2.js`)
- Replaced `.mousemove()` shorthand with `.on('mousemove', ...)` — deprecated in jQuery 3.0 (`js/p2.js`)
- Replaced `.attr('checked')` with `.prop('checked')` for three checkbox reads — `.attr()` returns the HTML attribute string, not the live boolean state (`js/p2.js`)
- Added `var` to `shortMonths`, `longMonths`, `shortDays`, `longDays` — were leaking as implicit globals (`js/wp-locale.js`)
- Added `var` to `contents` — was leaking as an implicit global (`js/caret.js`)

HTML5 standards:

- Replaced XHTML 1.1 DOCTYPE and `xmlns` attribute with `<!DOCTYPE html>` (`header.php`)
- Removed obsolete `profile` attribute from `<head>` (`header.php`)
- Replaced `<meta http-equiv="Content-Type">` with `<meta charset="...">` (`header.php`)
- Replaced direct `$post->ID` access with `get_the_ID()` in post format switch for PHP 8 safety (`entry.php`)

Deep-dive modernisation of remaining `inc/` files:

- Removed `inc/compat.php` — PHP 4/5 shims for `str_split()` and `str_ireplace()`, dead code since PHP 5.0; dropped from the includes array (`functions.php`)
- Replaced `create_function()` with an anonymous function in `usort()` call — `create_function` was removed in PHP 8.0 (`inc/widgets/recent-tags.php`)
- Replaced `extract($args)` with explicit variable assignments in both widget files to eliminate variable-injection risk (`inc/widgets/recent-tags.php`, `inc/widgets/recent-comments.php`)
- Replaced all `array( &$this, ... )` by-reference callbacks with `array( $this, ... )` — PHP4 by-reference passing is invalid in PHP 8 (`inc/search.php`, `inc/terms-in-comments.php`, `inc/widgets/recent-comments.php`)
- Changed `var` to `public` on all class properties in `P2_Post_List_Creator`, `P2_Comment_List_Creator`, `P2_List_Creator`, and `P2_Terms_In_Comments` (`inc/list-creator.php`, `inc/terms-in-comments.php`)
- Removed dead `$order` variable and trailing empty string from SQL query in `get_comment_meta()` (`inc/terms-in-comments.php`)
- Added missing `esc_js()` around `login_url` output; added missing `echo` on `rssUrl` JavaScript variable (was always emitting an empty string) (`inc/js.php`)

---

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
