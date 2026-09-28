# sepehresmaeily.com — theme & SEO/GEO plugin

Custom WordPress code for **آموزش کلیستنیکس سپهر اسماعیلی**.

| Folder | What it is | Installed to |
|---|---|---|
| `theme/sepehr/` | Lightweight RTL theme (desktop / tablet / mobile), WooCommerce-compatible | `wp-content/themes/sepehr` |
| `plugin/sepehr-seo-geo/` | Schema (Person, ExerciseGym, Course), AI-crawler robots rules, `/llms.txt`, front-page title & meta, performance clean-up | `wp-content/plugins/sepehr-seo-geo` |

## Business facts

Name, address, phone, class hours, credentials: **only** in
`plugin/sepehr-seo-geo/includes/facts.php`. The page, footer, schema and llms.txt
all read from there, so they can never disagree.

Values the owner edits without code live in **Appearance → Customize → تنظیمات سایت سپهر**:
course price, course URL, map link, photos, free-program form shortcode.

## Deploy (cPanel)

1. cPanel → **Git Version Control** → this repo → **Manage** → **Pull or Deploy**.
2. **Update from Remote**, then **Deploy HEAD Commit** (runs `.cpanel.yml`).
3. First time only: activate the plugin **Sepehr SEO & GEO**, then preview the theme
   with **Appearance → Themes → Sepehr Esmaeily → Live Preview** before activating it.

## Fonts

Vazirmatn and Cinzel, self-hosted (SIL Open Font License, see `theme/sepehr/assets/fonts/`).
