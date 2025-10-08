<?php

namespace App\Models;

use CodeIgniter\Model;

class LandingModel extends Model
{
    protected $table = 'landing_page';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'judul',
        'subjudul',
        'konten',
        'gambar',
        'status',
        'facebook',
        'instagram',
        'twitter',
        'linkedin',
        'youtube'
    ];

    public function getValue(string $field): ?string
    {
        $row = $this->where('status', 'aktif')->first();
        return $row[$field] ?? null;
    }

    public function getSocialLinks(): array
    {
        $row = $this->where('status', 'aktif')->first();

        return [
            'facebook'  => $row['facebook'] ?? null,
            'instagram' => $row['instagram'] ?? null,
            'twitter'   => $row['twitter'] ?? null,
            'linkedin'  => $row['linkedin'] ?? null,
            'youtube'   => $row['youtube'] ?? null,
        ];
    }
}
