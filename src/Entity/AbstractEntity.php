<?php

namespace App\Entity;

/**
 * AbstractEntity
 */
abstract class AbstractEntity
{
    //ISO 8601
    const DATE_FORMAT     = 'Y-m-d';
    const TIME_FORMAT     = 'H:i:s';
    const DATETIME_FORMAT = 'Y-m-d H:i:s';

    /**
     * The properties that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [];

    public function __set($name, $value)
    {
        if (property_exists($this, $name)) {
            $this->$name = $value;
        }
    }

    public function __get($name)
    {
        if (property_exists($this, $name)) {
            return $this->$name;
        }

        return null;
    }

    /**
     * @param array $data
     *
     * @return $this
     */
    public function fill(array $data)
    {
        foreach ($data as $key => $value) {
            if (!empty($this->fillable)) {
                if (in_array($key, $this->fillable)) {
                    $this->$key = $value;
                }
            } else {
                $this->$key = $value;
            }
        }

        return $this;
    }
}
