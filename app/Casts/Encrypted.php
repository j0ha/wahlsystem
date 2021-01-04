<?php

namespace App\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class Encrypted implements CastsAttributes
{
    /**
     * Entschlüsselt die Daten aus der Datenbank und übergibt sie an das Model
     *
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @param  string  $key
     * @param  mixed  $value
     * @param  array  $attributes
     * @return mixed
     */
    public function get($model, $key, $value, $attributes)
    {
        return $value === null ? null : \Crypt::decrypt($value);
    }

    /**
     * Verschlüsselt die durch das Model greichen Daten und übergibt sie an die Funktionen für den Datenbankeintrag
     *
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @param  string  $key
     * @param  array  $value
     * @param  array  $attributes
     * @return mixed
     */
    public function set($model, $key, $value, $attributes)
    {
        return $value === null ? null : \Crypt::encrypt($value);
    }
}
