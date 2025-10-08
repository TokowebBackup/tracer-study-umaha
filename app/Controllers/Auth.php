<?php

namespace App\Controllers;

use App\Models\AlumniModel;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Firebase\JWT\JWK;
use Google\Auth\OAuth2;

class Auth extends BaseController
{
    protected OAuth2 $oauth;

    public function __construct()
    {
        helper('url');
        $cfg = config('Google');

        $this->oauth = new OAuth2([
            'clientId'           => $cfg->clientID,
            'clientSecret'       => $cfg->clientSecret,
            'authorizationUri'   => 'https://accounts.google.com/o/oauth2/auth',
            'tokenCredentialUri' => 'https://oauth2.googleapis.com/token',
            'redirectUri'        => $cfg->redirectUri,
            'scope'              => $cfg->scopes,
        ]);
    }

    /** ────────── LOGIN MANUAL ────────── */
    public function login()
    {
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $alumniModel = new \App\Models\AlumniModel();
        $alumni = $alumniModel->where('email', $email)->first();

        if ($alumni && password_verify($password, $alumni['password'])) {
            session()->set([
                'alumni_id'   => $alumni['id'],
                'alumni_nama' => $alumni['nama'],
                'email'       => $alumni['email'],
                'logged_in'   => true,
            ]);
            return $this->response->setJSON([
                'success' => true,
                'redirect' => base_url('alumni/dashboard')
            ]);
        }

        return $this->response->setJSON(['success' => false, 'message' => 'Email atau Password salah']);
    }

    public function google()
    {
        // Redirect ke Google Consent
        $authUrl = $this->oauth->buildFullAuthorizationUri([
            'access_type' => 'offline',
            'prompt'      => 'select_account'
        ]);
        return redirect()->to((string) $authUrl);
    }

    public function googleCallback()
    {
        $code = $this->request->getGet('code');
        if (!$code) {
            return redirect()->to('/')->with('error', 'Login dibatalkan');
        }

        $this->oauth->setCode($code);

        try {
            $token = $this->oauth->fetchAuthToken();
        } catch (\Exception $e) {
            return redirect()->to('/')->with('error', 'Gagal ambil token: ' . $e->getMessage());
        }

        $idToken = $token['id_token'] ?? null;
        if (!$idToken) {
            return redirect()->to('/')->with('error', 'Token ID tidak ditemukan');
        }

        // ✅ Cara resmi
        $jwks = json_decode(file_get_contents('https://www.googleapis.com/oauth2/v3/certs'), true);
        $keys = JWK::parseKeySet($jwks);

        try {
            $payload = JWT::decode($idToken, $keys);
        } catch (\Exception $e) {
            return redirect()->to('/')->with('error', 'Token tidak valid: ' . $e->getMessage());
        }

        $email = $payload->email ?? null;
        if (!$email) {
            return redirect()->to('/')->with('error', 'Email tidak ditemukan di ID token');
        }

        // Login alumni
        $alumniModel = new \App\Models\AlumniModel();
        $alumni = $alumniModel->where('email', $email)->first();

        if (!$alumni) {
            $alumniId = $alumniModel->insert([
                'nama'       => $payload->name ?? $email,
                'email'      => $email,
                'password'   => password_hash(bin2hex(random_bytes(8)), PASSWORD_DEFAULT),
                'avatar_url' => $payload->picture ?? null,
                'created_at' => date('Y-m-d H:i:s')
            ]);
            $alumni = $alumniModel->find($alumniId);
        }

        session()->set([
            'alumni_id'   => $alumni['id'],
            'alumni_nama' => $alumni['nama'],
            'email'       => $alumni['email'],
            'logged_in'   => true,
        ]);

        echo "<script>
            if (window.opener) {
                window.opener.postMessage('google-login-success', '*');
                window.close();
            } else {
                window.location.href = '" . base_url('alumni/dashboard') . "';
            }
        </script>";
        exit;
        return redirect()->to(base_url('alumni/dashboard'));
    }


    // Ambil public key dari Google (hanya contoh cepat — bisa kamu cache biar gak download terus)
    protected function getGooglePublicKey()
    {
        $keys = json_decode(file_get_contents('https://www.googleapis.com/oauth2/v3/certs'), true);
        $keyData = $keys['keys'][0] ?? null;

        if (!$keyData) {
            throw new \RuntimeException('Gagal ambil public key dari Google');
        }

        $pem = $this->createPemFromModulusAndExponent(
            base64_decode($keyData['n']),
            base64_decode($keyData['e'])
        );

        return $pem;
    }

    protected function createPemFromModulusAndExponent($modulus, $exponent)
    {
        // shortcut (gunakan library seperti firebase/php-jwt jika ingin yang lebih proper)
        return "-----BEGIN PUBLIC KEY-----\n" . chunk_split(base64_encode($modulus), 64, "\n") . "-----END PUBLIC KEY-----\n";
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to(base_url('/'));
    }
}
