# Falling Dusk

Custom WordPress theme for [Dusk at the Mansion](http://duskatthemansion.com) — an electronic trio from Lisbon, Portugal.

## About the Band

Dusk at the Mansion was an electro/synth-pop trio from Lisboa, Portugal. Dark, melancholic and energetic, combining cello, drums, keyboards and electronic production.

**Members:** David Costa · Leihla Pinho · Ricardo Mestre

This repository serves as a historical record of the band's official website.

## About the Theme

*Falling Dusk* was a bespoke WordPress theme built from scratch for the band's official website. It featured custom post types for **Shows**, **Music** and **Press**, designed with a dark, minimal aesthetic using HTML5 and CSS3.

**Theme slug:** `datm`
**Theme version:** 1.0
**License:** [GNU GPL v2](_LICENSE.txt)

### Structure

```
datm/
├── assets/
│   ├── css/        # Stylesheets (boilerplate, fonts, global)
│   ├── fonts/      # Custom web fonts
│   ├── images/     # Theme images and icons
│   └── js/         # JavaScript files
├── languages/      # i18n/l10n files
├── style.css       # Theme declaration
├── functions.php   # Theme setup, custom post types, widgets
├── header.php
├── footer.php
├── sidebar.php
├── index.php
├── single.php
├── page.php
├── shows.php       # Custom template: Shows
├── music.php       # Custom template: Music
├── press.php       # Custom template: Press
└── ...
```

## Plugins

See [PLUGINS.md](PLUGINS.md) for the full list of WordPress plugins used on the site, including notes on two plugins deactivated due to PHP 8 incompatibilities.

## Credits

Design and development by **Ricardo Duplos** — [@ricardoduplos](https://github.com/ricardoduplos) · [duplos.org](http://duplos.org)

The theme is currently maintained by [Dinis Correia](https://github.com/diniscorreia) for archival purposes.
