<?php

/**
 * PHP version 7.1
 *
 * @package AM\Hashrate
 */

namespace AM\Hashrate;

use \AM\Blockinfo\Blocks;

/**
 * Mining profit calculator
 *
 * @author  Andrey Mashukov <a.mashukoff@gmail.com>
 */

class Calculator
    {

	/**
	 * Calculate reward
	 *
	 * @param float  $hashrate Miner hashrate
	 * @param string $currency Crypto currency name
	 * @param float  $poolfee  Pool fee
	 *
	 * @return float Miner reward
	 */

	public function calculate(float $hashrate, string $currency, float $poolfee = 0):float
	    {
		$blocks = new Blocks();
		$block  = $blocks->getNew($currency);

		$formulas = [
		    "dash"            => "dashformula",
		    "bitcoin"         => "btcformula",
		    "litecoin"        => "ltcformula",
		    "ethereum"        => "ethxmrformula",
		    "ethereumclassic" => "ethxmrformula",
		    "zcash"           => "zecformula",
		    "monero"          => "ethxmrformula",
		    "bitcoin-cash"    => "btcformula",
		];

		switch ($formulas[$currency])
		    {
			case "dashformula":
			    return (($hashrate * ($block["reward"]) / ($block["difficulty"] * pow(2, 32))) * (1 - $poolfee) * 3600) * 1.257;
			case "ethxmrformula":
			    return (($hashrate * ($block["reward"]) / ($block["difficulty"])) * (1 - $poolfee) * 3600);
			case "zecformula":
			    return (($hashrate * ($block["reward"]) / ($block["difficulty"])) * (1 - $poolfee) * 3600 * pow(10, -4) * 1.37073);
			case "btcformula":
			    return ((((($hashrate * $block["reward"]) / ($block["difficulty"] * pow(2, 32))) * (1 - $poolfee) * 3600)) * pow(10, -8));
			case "ltcformula":
			    return ((((($hashrate * $block["reward"]) / ($block["difficulty"] * pow(2, 32))) * (1 - $poolfee) * 3600)));
			default:
			    return 0;
		    }

	    } //end calculate()


    } //end class


?>
