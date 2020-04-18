<?php

namespace BigHairEnergy\Preview;

class Preview
{
    /**
     * Indicates if Preview migrations will be run.
     *
     * @var bool
     */
    public static $runsMigrations = true;

    /**
     * Configure Preview to not register its migrations.
     *
     * @return static
     */
    public static function ignoreMigrations()
    {
        static::$runsMigrations = false;

        return new static;
    }
}
