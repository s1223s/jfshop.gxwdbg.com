<?php
declare(strict_types=1);

/**
 *--------------------------------------------------------------------
 *
 * Draw Exception
 *
 *--------------------------------------------------------------------
 * Copyright (C) Jean-Sebastien Goupil
 * http://www.barcodebakery.com
 */
namespace code\src;

class BCGDrawException extends \Exception
{
    /**
     * Constructor with specific message.
     *
     * @param string $message
     */
    public function __construct($message)
    {
        parent::__construct($message, 30000);
    }
}
