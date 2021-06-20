<?php 

namespace App\Models\Enum;

abstract class Enum
{
    public static function listConstants()
    {
        $class = new \ReflectionClass(get_called_class());
        return $class->getConstants();
    }
}