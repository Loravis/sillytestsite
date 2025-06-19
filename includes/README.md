# Environment variables

Ensure a file named **env.php** exists in the includes directory before deploying the app. It must contain the following code;
```php
<?php
    putenv('USERNAME=localuser');
    putenv('PASSWORD=1234567');
?>
```