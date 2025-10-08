<?php

namespace App\Models;

use CodeIgniter\Model;

class SettingsModel extends Model
{
    protected $table = 'settings';
    protected $primaryKey = 'id';
    protected $allowedFields = ['key_name', 'value'];

    public function getValue($key)
    {
        return $this->where('key_name', $key)->first()['value'] ?? null;
    }

    public function setValue($key, $value)
    {
        $existing = $this->where('key_name', $key)->first();
        if ($existing) {
            return $this->update($existing['id'], ['value' => $value]);
        } else {
            return $this->insert(['key_name' => $key, 'value' => $value]);
        }
    }
}
