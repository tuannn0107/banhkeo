## First-time setup
### For Local
- Create database `cms`
- Run command `composer local`

### For Production
- Run command `composer prod`

## Start server
- Run command `php artisan serve`

## Information
- Home Template: [here](http://lencomeco.pgh.vn)
- Admin Template: [here](https://github.com/duongvalo/admin-template.git)
- Hosting: `103.97.124.191`

| Domain                                       | Database        | Rate  |
|----------------------------------------------|-----------------|-------|
| [mangkhobalan.com](https://mangkhobalan.com) | `admin_mangkho` | `2.5` |

# Document
## Command
### Setup
- Reinstall application: `php artisan install:fresh`
- `.env` has option `QUEUE_CONNECTION <sync|database>`

### Dump database
- Directory: `/database/sql/<all|schema|data>.sql`
- `php artisan dump schema` to dump schema file `dump-schema.sql`
- `php artisan dump data` to dump data file `dump-data.sql`
- `php artisan dump` to dump schema and data file `dump-all.sql`

- `Define all permission first, it is forbidden to change`
- `Common policy: 'post', specific policy: 'update-post', 'create-post'`

### Develop
- `php artisan admin:new <Model>` to generate crud
- `php artisan admin:remove <Model>` to remove crud
- `php artisan cms:make <File>` to generate data-cms
- `php artisan cms:validate` to validate unique data-cms

### VPS
- `mysqldump -u <username> -p <database> > dump.sql` to export sql
-  `mysql -u <username> -p <database> < dump.sql` to import sql

## Admin view
### Component
- `<x-input />`
- `<x-select />`
- `<x-textarea />`
- `<x-summernote />`
- `<x-dropify />`
- `<x-action />`

## Server Task Scheduling
### VPS Hosting
`cd /home/admin/web/<domain>/public_html && php artisan schedule:run >> /dev/null 2>&1`

### Shared Hosting
`/usr/local/bin/php /home/<username>/public_html/artisan schedule:run >> /dev/null 2>&1`

## Front-end
### CMS
- `data-cms` admin can change text, image tag
- `data-cms-background` admin can change background in css `background-image`
- `data-cms-listener` listener to `data-cms` and `data-cms-background` with same key
- `data-cms-clone` just clone data from `data-cms` with same key, no event

### Form
- In `<form>` add `class="js-form"`
- Support name `name, phone, email, address, content`. Example: `name="phone"`
- Default: `method="post"`, `action="/contact"`, advance: we can custom `method`, `action`

### Npm
- Place `.scss` files in `/resources/sass/home`
- Place `.js` files in `/resources/js/home`
- Config in `vite.config.js`

#### Support command:
- `npm run build` build final file `.css`, `.js`
- `npm run dev` auto build when changing `.scss`, `.js` file
