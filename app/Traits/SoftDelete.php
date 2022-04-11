<?php

namespace App\Traits;

use Framework\DatabaseHandler\exceptions\RecordNotFoundException;

/**
 * Ondersteuning voor soft deletes
 */
trait SoftDelete
{
    public static function findOne($options = [])
    {
        $result = parent::findOne($options);
        if(is_null($result->deleted_at))
            return $result;
        return null;
    }

    public static function findById($id)
    {
        $result = parent::findById($id);
        if(is_null($result->deleted_at))
            return $result;
        throw new RecordNotFoundException();
    }

    public static function findAll($options = [])
    {
       return parent::findAll(array_merge($options, ['deleted_at' => null]));
    }
}