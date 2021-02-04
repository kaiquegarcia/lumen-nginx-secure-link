<?php

namespace Nginx\SecureLink\Tests;

use Illuminate\Database\Eloquent\Model;
use Nginx\SecureLink\Traits\WithSecureLink;

class ModelExample extends Model
{
    use WithSecureLink;

    protected $fillable = ['link'];
}
