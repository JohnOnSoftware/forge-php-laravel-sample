# forge-php-laravel-sample - With dynamically generated Access Token.
## Introduction

- This is a basic sample to show the Forge Viewer with Laravel framework.

- Detail of installing Laravel, please check [https://laravel.com/docs/5.6](https://laravel.com/docs/5.6) 

- After create a Laravel project with  **laravel new blog**, do the following steps:

1. Create forge.blade.php under **resources/views/**, and copy/paster the Forge Viewer code from [Forge Viewer Tutorial](https://developer.autodesk.com/en/docs/viewer/v2/tutorials/basic-application/)

2. Update URN with correct one.

3. Update your .env file with the following 2 environment variables:
<pre><code>
    FORGE_CLIENT_ID="<< Your Client ID >>"
    FORGE_CLIENT_SECRET="<< Your Client Secret >>"
</pre>

4. start the server using **php artisan serve**, open **localhost:8000**, you will see the result 

# License

This sample is licensed under the terms of the [MIT License](http://opensource.org/licenses/MIT).
Please see the [LICENSE](LICENSE) file for full details.

## Written by

Zhong Wu [@JohnOnSoftware](https://twitter.com/JohnOnSoftware), [Forge Partner Development](http://forge.autodesk.com)
