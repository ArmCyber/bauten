<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;
use Illuminate\Foundation\Application;
use Illuminate\Contracts\Encryption\Encrypter;

class VerifyCsrfToken extends Middleware
{
    /**
     * Indicates whether the XSRF-TOKEN cookie should be set on the response.
     *
     * @var bool
     */
    protected $addHttpCookie = true;

    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        //
    ];

    public function __construct(Application $app, Encrypter $encrypter){
        $this->except = [
            route('ckfinder_connector', [], false),
            route('admin.logout', [], false),
        ];
        parent::__construct($app,$encrypter);
    }
}
