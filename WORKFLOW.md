# Working on the site

## After changes are pushed

Open Terminal and run the following, then refresh the site:

```
cd ~/"Local Sites"/deeprose-carter/app/public/wp-content/themes/deeprose-carter
git pull
```

Design and code changes appear straight away.

## When new page content is added

1. Run the two commands above.
2. In WP Admin, go to **Appearance → D&C setup** and click **Run setup again**.
3. Refresh and check the page.

Only use **Run setup again** while the site has demo content. It overwrites the demo pages.

## Working without Terminal

Start a Claude Code session in the Claude Desktop app, opened on this folder. It reads `CLAUDE.md` automatically and can edit the files directly.

## Branches

- `main`: the approved homepage build
- `service-pages`: service page work, starting with Extensions

To switch branch from this folder, run `git checkout main` or `git checkout service-pages`.

## If something goes wrong

| What you see | What to do |
|---|---|
| A command prints nothing | Usually fine; `cd` is silent when it works. Type `pwd` to see where you are. |
| "Not a git repository" | You're in the wrong folder. Run the `cd` line above first. |
| "Your local changes would be overwritten" | Files were edited on this Mac. Ask Claude before doing anything else. |
| Asked for a password | Use a GitHub personal access token, not your GitHub password. |
| The site shows a broken theme | Check the theme folder is called exactly `deeprose-carter`. |

Pinned guide: https://claude.ai/artifact/WvhxVj2oy7w2VgE3EY64ib
