<?php

namespace Nginx\SecureLink\Traits;

use Illuminate\Http\Request;

trait WithSecureLink
{
    protected $secure_link_ip_class_provider = Request::class;
    protected $secure_link_origin_attribute = 'link';

    private function generateSecureLink($url)
    {
        $secret = config('secure-link.secret');
        $expiresIn = time() + config('secure-link.tll');
        $userIp = app($this->secure_link_ip_class_provider)->ip();

        $url = parse_url($url);
        $urlBase = "{$url['scheme']}://{$url['host']}";
        $urlPath = $url['path'];

        $hash = md5("{$expiresIn}{$urlPath}{$userIp} {$secret}", true);
        $hash = base64_encode($hash);
        $hash = strtr($hash, '+/', '-_');
        $hash = str_replace('=', '', $hash);
        return "{$urlBase}{$urlPath}?md5={$hash}&expires={$expiresIn}";
    }

    protected function getSecureLinkAttribute()
    {
        $url = $this->{$this->secure_link_origin_attribute};
        if (!$url) {
            return null;
        }
        return $this->generateSecureLink($url);
    }
}
