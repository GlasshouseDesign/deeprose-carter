# Deeprose & Carter: project handover

Read this first. It sums up the project so far, so a new session can carry on where the last one finished. Then read `HANDOVER.md` for the history, links, Cloudways deployment and next steps.

## The project

- **Client:** Deeprose & Carter Developments, Chippenham, Wiltshire. A merger of J Deeprose Developments Ltd (founded 2019, Josh Deeprose) and CR Builders Limited (Callum Carter).
- **Agency:** Glasshouse Design (hello@glasshouse.design).
- **Build:** this repository is the custom WordPress theme. It runs locally in Flywheel Local, with **ACF PRO** required.
- **Strapline:** "Built around you". **Homepage headline:** "Quality you can build on".

## House rules

- **British English** throughout, and **no em dashes** in any copy or comments.
- **Headlines:** Trajan Pro 3 (Adobe Fonts, CSS family `trajan-pro-3`). Trajan has no lowercase, so headlines read as capitals and small capitals.
- **Body and UI:** Raleway (Adobe Fonts, `raleway`).
- **Colours** (in `assets/css/main.css` `:root`): navy `#1A2B4B`, deep navy `#132038`, slate `#60656B`, mist `#AEB4BF`, limestone/cream `#F4F1EB`, stone `#E6E0D6`, paper `#FBFAF7`.
- **Motif:** the four-pane window from the logo (`dc_win()` / `.win`) is used as the bullet in eyebrows and the services banner. The roofline and window appear in the final call to action.
- Use real D&C project photos only, never AI images or stock.

## Approved design

The client chose **"The Film"** direction:
- Cream header with the logo centred between two menus.
- A framed hero film, with a navy card overlapping its bottom edge.
- Sections alternate cream and navy.

Section order on the homepage:
1. Hero film
2. Intro and key figures
3. Scrolling services banner (navy)
4. Services grid
5. Featured projects (navy)
6. Client testimonial (Joe Davies)
7. Team
8. How we work (navy)
9. Detail gallery
10. Areas we cover
11. FAQs
12. Call to action (navy)
13. Footer

Changes the client has asked for, which are already done:
- The header has no Contact link or phone number, just Reviews and the "Request a quote" button.
- The FAQs and How we work buttons say "Contact us".
- The quote email is jo@jdeeprosedevelopments.co.uk (Site Settings → Quote email).
- The scrolling services banner was added above Services.
- The name tiles in the Team section were removed.
- The hero card is a little smaller (552px wide, 46px headline), so more of the film shows.
- Intro strong line: "You bring us the idea, we take care of the rest." Public liability cover: £10M.
- The Mile Elm project is now in Calne and described as a full top-to-bottom renovation inside and out, with the extension.
- Company number 12007910 is in Site Settings (footer text).
- Three new orangery-style extension photos (`demo/img/orangery-*.jpg`) are in the Extensions gallery.
- The footer credit reads "Website by glasshouse.design", linking to https://glasshouse.design. It is set in `footer.php`, not in Site Settings.
- A second review, from Jon & Amy Ladd (garage conversion), is on the Conversions page. A service can replace the shared review with its own `testimonial` key.
- The homepage FAQ answers are written, using details already confirmed (£10M cover, free quotes, no timescales).
- Privacy policy written for UK GDPR (`inc/demo-privacy.php`), set as the WordPress privacy page by the D&C setup.
- Favicon from the DC mark on a cream tile (`assets/icons/`), output by `dc_favicon()` unless a Site Icon is set in the Customiser.
- Footer company details carry the legal disclosures: Deeprose and Carter Developments Ltd (renamed from J Deeprose Developments Ltd in August 2026), company no. 12007910, registered office The Old Post Office, 41-43 Market Place, Chippenham, SN15 3HR.
- Bump `DC_VERSION` in `functions.php` whenever CSS or JS changes, so browsers and Cloudways caches pick up the new files.

## How the theme works

- **Pages and services** use the ACF flexible content field `page_sections`. There is one template per layout in `template-parts/sections/`; the layout `hero_film` maps to the file `hero-film.php`. They are rendered by `dc_render_sections()` in `inc/helpers.php`.
- **Field groups** are stored as ACF local JSON in `acf-json/`, and edits made in the ACF admin are saved back there. There is also a generator script, but the JSON is the source of truth now.
- **Content types** (`inc/content-types.php`):
  - `service` (archive `/services/`, ordered by menu order)
  - `project` (archive `/projects/`), with the `project_type` taxonomy
- **Site Settings** is an ACF options page (`dc-site-settings`), read with `dc_setting( 'name', $fallback )`. It holds the phone number, quote email, WhatsApp, public email, address, header button, strapline, footer text, social links, company details and the Adobe Fonts kit ID.
- **Menus:**
  - `primary-left` and `primary-right` (either side of the logo)
  - `mobile`
  - `footer-services`, `footer-company` and `footer-legal`
  - Header links are output as plain anchors by `dc_menu_links()`.
- **Editing:** pages and services use the classic editor, with the sections under the title. Blog posts use the block editor.
- **JavaScript** (`assets/js/site.js`):
  - the header shrinks on scroll
  - mobile menu (`.menu-toggle` / `#mnav`)
  - film pop-up: `[data-film="url"]` opens `#filmbox`
  - scroll reveals (`.reveal`, `.reveal-img`) and count-up figures (`data-count`)
  - everything respects `prefers-reduced-motion`
- **Demo setup:** Appearance → D&C setup (`inc/demo-setup.php`). It imports media from `demo/` and creates the pages, services, projects, menus and settings. Items are tagged with the `_dc_demo_key` post meta, so running it again updates rather than duplicates. Don't run it once real content exists.

## Still to do

1. **Service pages:** all seven are written (branch `service-pages`) and waiting for client review. Extensions came first; the other six use the same sections through `dc_demo_service_page()`, which takes one content array per service. It uses five service layouts: `page_hero`, `service_detail` (SEO description, included list, at-a-glance facts and a contact card), `options_grid`, `photo_gallery` (ACF gallery field with a lightbox; captions come from each image's Media Library caption) and `contact_panel`. It also reuses `testimonial`, `process` and `faqs`. The content lives in `inc/demo-services.php`, one function per service. Copy rules: no prices or timescales unless the client supplies them. Conversions and New Builds have no gallery until there are real photos. Points for the client to check are listed in `HANDOVER.md`.
2. **Contact page:** merged into `service-pages`. It uses `page_hero`, a `contact_form` layout and `areas`. The `contact_form` section shows the shortcode in its "Form shortcode" field, otherwise the theme's built-in form (`inc/contact-form.php`, emails the quote address with up to 5 photos, stores nothing). When Gravity Forms is active, the D&C setup builds the "Request a quote" form with the same fields (`inc/gravity-forms.php`, `dc_gf_quote_form()`, ID kept in the `dc_gf_quote_form` option) and puts its shortcode on the Contact page. The notification always goes to Site Settings → Quote email, attaches the uploads, stores no IP addresses and deletes entries after 2 years, to match the privacy policy. Gravity Forms output is styled under `.cf-box`. In Local, sent emails appear in Mailpit (Local → Tools → Mailpit). Before launch: an SMTP plugin on Cloudways, and a test submission.
3. About page design, project page design, and the blog listing and article design refinements.
4. SEO: Rank Math or Yoast, plus LocalBusiness schema.
5. Before launch:
   - Create an Adobe Fonts web project for the live domain, and update the kit ID in Site Settings (the current `jtl2yxi` was made for the concepts).
   - Replace the placeholders: phone number, WhatsApp, the XX figures (years' experience and projects completed), FAQ answers, the Loft & Garage Conversions photo, project write-ups and the sample blog post.
   - Update the team photo: the jumpers show the old logo.

## Open questions for the client

- **"Callum" or "Calum"?** The review says Calum. Use one spelling everywhere once confirmed.
- **Email address:** is jo@jdeeprosedevelopments.co.uk staying, or moving to a new domain?
- The real figures for years' experience and projects completed.
