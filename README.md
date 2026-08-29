# Multi Store

A multi-tenant e-commerce app built on Laravel + Inertia + Vue. Each "store" is a
separate tenant, resolved purely from the request's hostname — there's no path
prefix or query param involved.

**Stack:** Laravel 13 · PHP 8.3+ · Jetstream 5 (Inertia) · Vue 3 · Vite ·
Nova 5 (admin panel) · MySQL

## Requirements

- PHP 8.3+
- Composer 2
- Node 20.19+ and npm
- MySQL (or another Laravel-supported DB — see below)

## 1. Install dependencies


```bash
composer install
npm install
```

## 2. Configure the environment

```bash
cp .env.example .env
php artisan key:generate
```

Open `.env` and set your database credentials:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=multi-store
DB_USERNAME=root
DB_PASSWORD=
```

Create that database (`multi-store`, or whatever name you chose) in MySQL before
continuing — Laravel won't create it for you.

## 3. Run migrations and seed the database

```bash
php artisan migrate --seed
```

This creates the schema and seeds two tenants plus sample categories/products:

| Tenant | Domain |
|---|---|
| store-one | `store-one.localhost` |
| store-two | `store-two.localhost` |

> Seeding only `TenantSeeder` (skipping the sample catalog) is
> `php artisan db:seed --class=Database\\Seeders\\TenantSeeder`.

## 4. Make the tenant domains resolve

Every request is gated by tenant middleware — it 404s unless the request's
Host header matches a tenant's `domain` column, so plain `localhost` won't work.

On most modern systems, `*.localhost` hostnames already resolve to `127.0.0.1`
automatically (no setup needed) — try skipping this step first. If it doesn't
work for you, add entries manually:

```
# /etc/hosts (Linux/macOS) or C:\Windows\System32\drivers\etc\hosts (Windows)
127.0.0.1 store-one.localhost
127.0.0.1 store-two.localhost
```

## 5. Run the app

You need two processes running side by side in development:

```bash
# Terminal 1 — PHP dev server
php artisan serve

# Terminal 2 — Vite dev server (hot-reloads Vue/CSS changes)
npm run dev
```

Then visit **http://store-one.localhost:8000** (or `store-two.localhost:8000`
for the second tenant, or match whatever port `artisan serve` printed).

For a production-style build instead of the Vite dev server, run `npm run build`
once and skip `npm run dev` — `php artisan serve` alone will then serve the
compiled assets from `public/build`.

## 6. Create an account

There's no seeded user — register one from the app itself:

1. Visit `http://store-one.localhost:8000/register`
2. Fill in the form

That account can now log in, browse `/products`, and use `/cart`.

### Admin panel (Nova)

Any logged-in user can reach `/nova` while `APP_ENV=local` (see the `viewNova`
gate in `app/Providers/NovaServiceProvider.php` — it's empty, so this
environment check is what's actually granting access; for a non-local
deployment you'd list allowed emails there instead). Log in with the account
you just registered and go to `http://store-one.localhost:8000/nova`.

## Running tests

```bash
php artisan test
```

⚠️ `phpunit.xml` doesn't point tests at a separate database, so the test suite's
`RefreshDatabase` trait runs against — and wipes — the same database configured
in your `.env`. Re-run step 3 (`php artisan migrate --seed`) afterwards to get
your dev data back, or configure a dedicated test database/connection first if
you'd rather avoid that.

## Useful routes

| Route | Purpose |
|---|---|
| `/` | Public landing page |
| `/register`, `/login` | Auth |
| `/dashboard` | Account settings (profile, API tokens, 2FA) |
| `/products`, `/products/{id}` | Storefront catalog |
| `/cart` | Shopping cart |
| `/nova` | Admin panel |
