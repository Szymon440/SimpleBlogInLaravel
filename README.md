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

All posts 
![image](https://github.com/user-attachments/assets/04376c55-fb8e-4358-b6e2-72c0e54053bb)

My posts
![image](https://github.com/user-attachments/assets/46c01127-1bb9-4077-b750-8ee4b6743aa9)


