# Environment variables

Ensure a file named **env.php** exists in the includes directory before deploying the app. It must contain the following code;
```php
<?php
    putenv('DB_USERNAME=localuser');
    putenv('DB_PASSWORD=1234567');
?>
```

Replace localuser and 1234567 with your invidual mySQL login details. 