# Deeprose & Carter: session handover

A record of the work so far and where it stands, so a new session can pick up without the old chat. Read `CLAUDE.md` first for the house rules and how the theme works; this file adds the history, the links, the Cloudways deployment and the next steps.

Last updated: 28 October 2026.

## People and accounts

- **Agency:** Glasshouse Design (Jon), hello@glasshouse.design.
- **Client:** Deeprose & Carter Developments, Chippenham. Owners Josh Deeprose and Callum Carter (spelling still to confirm).
- **Quote email:** jo@jdeeprosedevelopments.co.uk.
- **GitHub:** https://github.com/GlasshouseDesign/deeprose-carter (private).
- **Figma:** wireframes v1 at https://www.figma.com/design/pw0ZviRxZPeN3GRQxT8pEZ (on Jon's connected account, not yet the Glasshouse one).
- **Hosting:** Local (Flywheel) for development; Cloudways for staging and, later, live.
- **Local theme folder:** `~/Local Sites/deeprose-carter-developments/app/public/wp-content/themes/deeprose-carter`

## Links

- Design viewing page (concepts, the chosen Film homepage, the A2 homepage, Extensions, brand film and logo animation): https://claude.ai/artifact/7QkMFV35uVRuoW4E2bETmp
- Workflow guide, pinned (Terminal routine, branches, troubleshooting): https://claude.ai/artifact/WvhxVj2oy7w2VgE3EY64ib

## What has been done

1. **Discovery.** Reviewed the brief, logo, draft copy, the Facebook page and four reference sites (Collstone Projects, The Construction Collective, Next Level, Shpati Construction). Recommended WordPress with ACF PRO and a section-based build.
2. **Wireframe** in Figma covering every page type.
3. **Visual concepts** for above the fold: A (Gable), A2 (navy Gable with cream header and banner), B and C (The Film). Trajan Pro 3 headlines, Raleway body, real D&C photos, a branded hero film and a logo animation.
4. **The client chose The Film.** A full, working HTML homepage was built with hover states, scroll reveals, count-up figures, the film pop-up and the scrolling services banner, then revised for the client's changes (see `CLAUDE.md`, Approved design).
5. **WordPress theme** (this repository): all homepage sections as ACF flexible content, services and projects post types, the blog, Site Settings, menus, and a one-click demo setup. Tested in a clean WordPress with every page returning 200 and no PHP warnings.
6. **Service pages:** five new layouts and the full Extensions page (branch `service-pages`). Client review copy with [CHECK] points was supplied as "Extensions - copy for review.md".
7. **Workflow:** Jon's Local site is a git clone of this repository on `service-pages`, updated with `git pull`. See `WORKFLOW.md`.

## Branches

| Branch | Contents |
|---|---|
| `main` | The approved homepage build. |
| `service-pages` | Everything on `main` plus the service layouts, the Extensions content, `WORKFLOW.md` and this file. |

Recommendation given to Jon, awaiting a yes: merge `service-pages` into `main`, point Cloudways at `main`, and do future work on short-lived branches that are merged once approved.

## Deploying to Cloudways via Git

The theme has no build step, so Cloudways' built-in Git deployment can pull it straight from GitHub.

1. **Cloudways:** Applications → the site → **Deployment via Git** → **Generate SSH keys** → **View SSH key**, and copy it.
2. **GitHub:** the repository → Settings → **Deploy keys** → Add deploy key. Title "Cloudways", paste the key, leave write access unticked.
3. **Clear the target folder:** if the theme was uploaded by hand to `public_html/wp-content/themes/deeprose-carter`, rename it (for example `deeprose-carter-old`). Cloudways needs an empty or new folder.
4. **Connect:** Git remote address `git@github.com:GlasshouseDesign/deeprose-carter.git` → Authenticate → choose the branch → deployment path `wp-content/themes/deeprose-carter` → Start deployment.
5. **WordPress on Cloudways:** install and activate ACF PRO, activate the Deeprose & Carter theme, then run Appearance → D&C setup once if the site is empty.
6. **Each update:** after a push, click **Pull** in Deployment via Git.

Notes:
- The folder name must be exactly `deeprose-carter`.
- Git only carries the theme. Pages, settings and media live in each site's database, so Local and Cloudways content are separate.
- Optional automatic deploys: Jon can create a Cloudways API key (Account → API) and add it, with the Cloudways login email, as secrets in the Claude environment settings. A session can then trigger the pull over HTTPS after each push. Never paste the key into chat.
- Cloud sessions cannot reach servers over SSH or SFTP (port 22 is blocked); GitHub and the Cloudways API over HTTPS both work.

Status: steps explained to Jon; not yet confirmed as working.

## Next steps

In order:

1. **Confirm the Cloudways deployment works**, and get a yes on merging `service-pages` into `main`.
2. **Send the Extensions page to the client** with the review copy and collect the [CHECK] answers.
3. **Contact page and quote form.** Still waiting to hear whether Jon has Gravity Forms or WPForms (or build it to suit either). It should send to the quote email and accept photo uploads.
4. **Project page design**, then the **About page**, then blog listing and article refinements.
5. **The other six services** once Extensions is approved: Kitchens, Conversions, Renovations, Structural Alterations, Groundworks & Landscaping, New Builds. Same pattern as `dc_demo_service_extensions()` in `inc/demo-services.php`. No prices or timescales unless the client supplies them.
6. **SEO:** Rank Math or Yoast, LocalBusiness schema.
7. **Before launch:** see `CLAUDE.md`, Still to do, item 5.

## Open questions for the client

- Callum or Calum?
- Is jo@jdeeprosedevelopments.co.uk staying or moving to a new domain?
- Real figures: years' experience, projects completed, insurance cover.
- Accreditations and memberships to show.
- The Extensions [CHECK] points: recommended architects, the included list, gallery captions, a guarantee or typical timescale, and a review from an extension client.
- A new team photo with the new logo.

## Files outside the repository

Earlier deliverables were made in the previous cloud session and sent to Jon as downloads: the HTML homepage and concept packages (zip), the theme zip and setup guide, the Extensions review copy and screenshots, the project photos and the films. They are not stored in this repository apart from the photos and films in `demo/`. If Jon needs one again, ask Jon for their downloaded copy or rebuild it from the theme.
