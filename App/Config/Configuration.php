<?php

namespace App\Config;

/**
 * Class Configuration
 * Main configuration for the application
 * @package App\Config
 */
class Configuration
{
    public const DB_HOST = 'localhost';
    public const DB_NAME = 'dogwalking';
    public const DB_USER = 'root';
    public const DB_PASS = 'dtb456';

    public const LOGIN_URL = '/';

    public const ROOT_LAYOUT = 'root.layout.view.php';

    public const DEBUG_QUERY = false;

    public const UPLOAD_DIR = "public/files/";
    public const DEFAULET_PROFILE_PICTURE = "http://ssl.gstatic.com/accounts/ui/avatar_2x.png";
    public const DEFAULT_DOG_PICTURE = "https://static.thenounproject.com/png/703120-200.png";
    public const LOST_DOG_PICTURE = "https://upload.wikimedia.org/wikipedia/commons/thumb/e/e5/Missing_dog_photo.svg/1165px-Missing_dog_photo.svg.png";
    public const DOG_EQUIPMENT = "https://www.akc.org/wp-content/uploads/2019/05/Untitled-design-4.jpg";
}