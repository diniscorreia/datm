# Plugins

Plugins used on the Dusk at the Mansion WordPress installation.
Versions reflect the state of the site as of March 2026.

## Active

| Plugin | Version | Notes |
|--------|---------|-------|
| [Akismet](https://wordpress.org/plugins/akismet/) | 5.6 | Spam protection |
| [Ambrosite Next/Previous Post Link Plus](https://wordpress.org/plugins/ambrosite-nextprevious-post-link-plus/) | — | Post navigation used in single templates |
| [Facebook Comments Plugin](https://wordpress.org/plugins/facebook-comments-plugin/) | — | Comments on posts |
| [Google Sitemap Generator](https://wordpress.org/plugins/google-sitemap-generator/) | 4.1.23 | XML sitemap |
| [Improved Include Page](https://wordpress.org/plugins/improved-include-page/) | — | Used in templates to include pages by slug |
| [Jetpack](https://wordpress.org/plugins/jetpack/) | — | Stats, sharing, and other site features |
| [Latest Tweets](https://wordpress.org/plugins/latest-tweets/) | — | Twitter feed in sidebar |
| [Links in Captions](https://wordpress.org/plugins/links-in-captions/) | — | Allows links in image captions |
| [Regenerate Thumbnails](https://wordpress.org/plugins/regenerate-thumbnails/) | 3.1.6 | Utility — not required at runtime |
| [Replace Content Image Size](https://wordpress.org/plugins/replace-content-image-size/) | — | Image size handling in post content |
| [Simple Image Sizes](https://wordpress.org/plugins/simple-image-sizes/) | 3.2.4 | Registers custom image sizes used by the theme |
| [Merge Tags](https://wordpress.org/plugins/merge-tags/) | 1.2 ⚠️ | Tag merging utility — abandonware (last updated 2010), patched for PHP 8 compatibility (see below) |
| [Taxonomic SEO Permalinks](https://wordpress.org/plugins/taxonomic-seo-permalinks/) | — | SEO-friendly permalink structure |
| [W3 Total Cache](https://wordpress.org/plugins/w3-total-cache/) | 2.9.3 | Page caching |
| [YouTube Embed](https://wordpress.org/plugins/youtube-embed/) | 5.4 | Video embeds in the Music section |

### Merge Tags — PHP 8 patch

The plugin is abandonware and will not receive upstream updates. In March 2026 all four methods in the `Merge_Tags` class (`init`, `handler`, `notice`, `script`) were declared `static` to fix a fatal error introduced by PHP 8's strict enforcement of static method calls. No logic was changed.

## Deactivated

These plugins were deactivated in March 2026 due to PHP 8 incompatibilities and have no available fix.

| Plugin | Reason |
|--------|--------|
| SoundCloud is Gold | Fatal error: `create_function()` removed in PHP 8.0 — plugin abandoned |
