# SimpleBlogInLaravel

### **Admin data**
  **email: admin@example.com
  password: secret**

### **Start app**

- run `git clone git@github.com:Szymon440/SimpleBlogInLaravel.git`
- `cd SimpleBlogInLaravel/app`
- run `composer update`
- run `New-Item -ItemType Directory -Path storage/framework/sessions, storage/framework/views, storage/framework/cache`
- `cd SimpleBlogInLaravel/docker`
- run `docker-compose up -d`
- run `docker exec -it laravel_app /bin/bash `
- run `npm install`
- run `npm run build`
- run `php artisan migrate`
- run `php artisan migrate --seed`

if occurs error "Please provide a valid cache path"

**Create these folders under storage/framework:**
- sessions
- views
- cache
