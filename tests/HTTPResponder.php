<?php

/**
 * PHP version 7.1
 *
 * @package AM\Hashrate
 */

/**
 * Responder for blockchair api
 *
 * @author  Andrey Mashukov <a.mashukoff@gmail.com>
 */

if ($_GET["currency"] !== "bch")
    {
	echo file_get_contents(__DIR__ . "/../vendor/andrey-mashukov/blockinfo/tests/mockdata/response.json");
    }
else
    {
	echo file_get_contents(__DIR__ . "/mockdata/response.json");
    } //end if


?>