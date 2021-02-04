# lumen-nginx-secure-link
Trait to easily adapt a Lumen/Laravel project for using NGINX secure link

## Install & Setup

Require this package to your Lumen/Laravel project with composer;

### Laravel / Lumen Setup

1. Add `NGINX_SECURE_LINK_SECRET` and `NGINX_SECURE_LINK_TTL` to your `.env` file;
2. Run `php artisan vendor:publish --provider="Nginx\SecureLink\Providers\SecureLinkServiceProvider"`;
3. Run `php artisan config:clear`.

### Nginx Setup

You need to create a configuration to each route you want to keep signed.
And before making any setup, remember to compile the source or run `apt get install nginx-extras`.

NGINX Configuration (usage example https://yourdomain.com/signed-route/file.zip)
```
        location /signed-route/ {
                secure_link $arg_md5,$arg_expires;
                secure_link_md5 "$secure_link_expires$uri$remote_addr NGINX_SECURE_LINK_SECRET";

                if ($secure_link = "") { return 403; }
                if ($secure_link = "0") { return 410; }

        }
```


## Explaining those environments

1. `NGINX_SECURE_LINK_SECRET` is the "password" you gonna keep in the back-end. You must put it on your environment file AND in each nginx configuration;
2. `NGINX_SECURE_LINK_TTL` is the time in seconds the generated secure_link will expire.

## How to use

Add to your Eloquent Model a simple `use \Nginx\SecureLink\Traits\WithSecureLink` and you'll be ready, considering the attribute origin's called `link`. For example:

### Model implementation

```php
class ModelExample extends \Illuminate\Database\Eloquent\Model
{
  use \Nginx\SecureLink\Traits\WithSecureLink;
  protected $fillable = ['link'];
}
```

### Usage
```php
$example = new ModelExample();
$secure_link = $example->secure_link;
```

## Customizing the origin attribute

You can and should have the possibility to create the secure_link based on other model attributes. To do this, just override the protected property `$secure_link_origin_attribute`. For example:

### Model implementation

```php
class ModelExample extends \Illuminate\Database\Eloquent\Model
{
  use \Nginx\SecureLink\Traits\WithSecureLink;
  protected $fillable = ['my_custom_url'];
  protected $secure_link_origin_attribute = 'my_custom_url';
}
```

## Customizing the IP Provider

As this project were made to Lumen framework, it can have some failures when trying to catch the user Client IP. The reason for that is we're using the class `Illuminate\Http\Request` to reach the `ip` method.
If you have any trouble with this, you can develop any class you want to with the same method and override the protected property `$secure_link_ip_class_provider`. For example:

### IP Provider implementation

```php
class IpProvider extends \Illuminate\Http\Request
{
  public function ip()
  {
    return "the-right-ip";
  }
}
```

### Model implementation

```php
class ModelExample extends \Illuminate\Database\Eloquent\Model
{
  use \Nginx\SecureLink\Traits\WithSecureLink;
  protected $fillable = ['link'];
  protected $secure_link_ip_class_provider = IpProvider::class;
}
```
