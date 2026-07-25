# AXIOO-inspired Tailwind Multi-page Project

A complete static front-end project inspired by the editorial structure and page taxonomy of the referenced Axioo photography website.

## Included pages

- `index.html` — homepage with full-screen hero carousel
- `photography.html` — main photography archive
- `photography-she-said-yes.html`
- `photography-tying-the-knot.html`
- `photography-family.html`
- `photography-baby-maternity.html`
- `photography-portraiture.html`
- `videography.html`
- `videography-she-said-yes.html`
- `videography-tying-the-knot.html`
- `journal.html`
- `story.html` — editorial story detail and gallery
- `about.html` — studio profile and filterable team directory
- `team-member.html` — photographer profile
- `contact.html` — validated demo enquiry form
- `faq.html` — accordion FAQ
- `404.html`

## Features

- Tailwind CSS Browser CDN; no build step required
- Responsive mega menu and mobile drawer
- Search overlay with local index
- Hero carousel
- Category filtering
- Team filtering
- Masonry galleries and image lightbox
- Scroll reveal animation
- FAQ accordion
- Front-end form validation and toast
- Shared external CSS and JavaScript

## Run

Open `index.html` directly, or serve the folder locally:

```bash
python3 -m http.server 8080
```

Then open `http://localhost:8080`.

## Production notes

- All photography is loaded from Unsplash as placeholder imagery.
- Replace demo copy, placeholder contact information, and remote assets before production.
- The contact form is front-end only. Connect it to your Laravel/API backend.
- The project is an independent implementation and does not include proprietary source code, logos, or original media from the referenced website.


## Optional Tailwind development

The compiled Tailwind stylesheet is already included. To rebuild it after adding new utility classes:

```bash
npm install
npm run build:css
```

## Homepage design

`index.html` now uses the supplied editorial homepage design, with its navigation connected to the project's photography, videography, journal, story, about, contact, and FAQ pages. Tailwind CSS is compiled locally into `assets/css/tailwind.css`.

## Unified header

All pages now use the same header structure as `index.html`, including the desktop dropdown navigation, full-screen mobile menu, search overlay, and scroll transition. Image-led pages use the transparent overlay state; content-led pages use the solid state for readability.
