## SETUP GUIDE

Clone repository using git command ``

### On the termial for todo-backend run a series of commands

```sh
1. composer install
2. php artisan migrate
3. php artisan key:generate
```
### Please note keep the backend and frontend running at the same time

### Additional needed step to prevent cors issue

```sh
php artisan serve --host=api.todo-backend.test --port=8000
```

### Windows please edit the file `C:\Windows\System32\drivers\etc\hosts`

```sh
127.0.0.1 api.todo-backend.test  
```

### Run this command 

```sh
php artisan serve --host=api.todo-backend.test --port=8000
```