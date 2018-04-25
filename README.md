# forge-php-laravel-sample
## Introduction

This is a basic sample to show the Forge Viewer with Laravel framework.

Detail of installing Laravel, please check [https://laravel.com/docs/5.6](https://laravel.com/docs/5.6) 

After create a Laravel project with 
- **laravel new blog**

Do the following steps:

1. Create forge.blade.php under **resources/views/**, and copy/paster the Forge Viewer code from [Forge Viewer Tutorial](https://developer.autodesk.com/en/docs/viewer/v2/tutorials/basic-application/)

2. Update URN & AccessToken with correct ones.

3. Redirect main page to above view by:<pre><code>
Route::get('/', function () {
    return view('forge');
});</pre>

4. start the server using **php artisan serve**, open **localhost:8000**, you will see the result 

# License

This sample is licensed under the terms of the [MIT License](http://opensource.org/licenses/MIT).
Please see the [LICENSE](LICENSE) file for full details.

## Written by

Zhong Wu [@JohnOnSoftware](https://twitter.com/JohnOnSoftware), [Forge Partner Development](http://forge.autodesk.com)
