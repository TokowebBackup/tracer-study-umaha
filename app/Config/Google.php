<?php

/**
 * @author Puji Ermanto<pujiermanto@gmail.com>
 * @license https://opensource.org/licenses/MIT
 * @copyright Copyright (c) 2023, Puji Ermanto
 * @return void
 * 
 * @property string $clientID
 * @property string $clientSecret
 * @property string $redirectUri
 **/

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Google extends BaseConfig
{
    public string $clientID     = '';
    public string $clientSecret = '';
    public string $redirectUri  = '';
    public array  $scopes       = ['email', 'profile'];

    public function __construct()
    {
        parent::__construct();

        $this->clientID     = (string) getenv('GOOGLE_CLIENT_ID') ?: '';
        $this->clientSecret = (string) getenv('GOOGLE_CLIENT_SECRET') ?: '';
        $this->redirectUri  = (string) getenv('GOOGLE_REDIRECT_URI') ?: '';
    }
}
