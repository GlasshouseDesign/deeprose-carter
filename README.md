# Deeprose & Carter WordPress theme

Custom theme for Deeprose & Carter Developments, built from the approved "The Film" homepage design.

## Requirements

- WordPress 6.4 or later, PHP 8.0 or later
- **Advanced Custom Fields PRO** (installed and activated before running the setup)

## Setting up in Local (Flywheel)

1. In Local, click **+** and choose **Create a new site**. Name it `deeprose-carter`.
2. Choose **Preferred** (PHP 8.2 or later, nginx, MySQL 8). Set an admin username and password.
3. When the site is ready, click **WP Admin**.
4. **Plugins → Add New → Upload Plugin**: upload the ACF PRO zip, install and activate it. Add your ACF licence key under **ACF → Updates**.
5. **Appearance → Themes → Add New → Upload Theme**: upload `deeprose-carter.zip`, install and activate it.
6. **Appearance → D&C setup → Set up demo content**. This takes around 10 to 30 seconds.
7. Click **View the site**.

If the theme upload is refused as too large, unzip it and copy the `deeprose-carter` folder into the site's `app/public/wp-content/themes/` folder instead (in Local: right-click the site, **Reveal in Finder**), then activate it under Appearance → Themes.

## What the setup creates

- The photos, hero loop and brand film in the Media Library
- **Home** (all 12 sections, set as the front page), **About**, **Contact** and **News & advice** (the blog)
- Seven **Services** and three **Projects**, with photos and project types
- A sample blog post
- **Site Settings**: phone, quote email, footer text, social links, Adobe Fonts project ID
- All menus: header left, header right, mobile, footer services, footer company, footer legal

Running it again updates these items rather than duplicating them, and overwrites any edits made to them. Don't run it again once real content has been entered.

## Where things are edited

| To change | Go to |
|---|---|
| Homepage and other page content | Pages → edit the page → **Page sections** (drag to reorder, **Add section** for more) |
| Menus | Appearance → Menus |
| Phone, emails, WhatsApp, footer, social links | **Site Settings** |
| Services (tiles and pages) | **Services**: title, featured image (tile photo), card summary, page sections |
| Projects | **Projects**: title, featured image, location, summary, project types, gallery |
| Blog posts | Posts (block editor) |

### Available page sections

Hero film · Intro and key figures · Scrolling services banner · Services grid · Featured projects · Client testimonial · Team · How we work · Detail gallery · Areas we cover · FAQs (adds FAQ structured data for Google) · Call to action · Text block

## Fonts

Trajan Pro 3 and Raleway load from Adobe Fonts using the project ID in Site Settings → Fonts. The current ID (`jtl2yxi`) was created for the design concepts. Before launch, create a web project in the client's Adobe Fonts account with both fonts, add the live domain, and paste its ID into Site Settings.

## Placeholders to replace before launch

- Phone number, company number, WhatsApp number (Site Settings)
- Key figures: XX+, XXX+, £XM (Home → Intro and key figures)
- FAQ answers (Home → FAQs)
- Loft & Garage Conversions photo (Services → Loft & Garage Conversions → featured image)
- Team photo: the jumper logos need updating
- Project write-ups and the sample blog post
- "Read more reviews" link (currently the Facebook page)

## Theme structure

```
acf-json/            Field groups (loaded automatically; edits made in ACF are saved here)
assets/css/main.css  All styles
assets/js/site.js    Header, mobile menu, film pop-up, scroll animations
inc/                 Setup, content types, ACF settings, demo setup
template-parts/sections/  One template per page section
front-page.php, page.php, single-*.php, archive-*.php, index.php (blog), single.php (post)
demo/                Photos and films used by the setup (can be deleted after setup)
```
