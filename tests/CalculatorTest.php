<?php

/**
 * PHP version 7.1
 *
 * @package AM\Hashrate
 */

namespace Tests;

use \PHPUnit\Framework\TestCase;
use \Logics\Tests\InternalWebServer;
use \AM\Hashrate\Calculator;
use \Exception;

/**
 * Tests for hashrate calculator
 *
 * @author  Andrey Mashukov <a.mashukoff@gmail.com>
 *
 * @runTestsInSeparateProcesses
 */

class CalculatorTest extends TestCase
    {

	use InternalWebServer;

	/**
	 * Name folder which should be removed after tests
	 *
	 * @var string
	 */
	protected $remotepath;

	/**
	 * Testing host
	 *
	 * @var string
	 */
	protected $host;

	/**
	 * Sets up the fixture, for example, opens a network connection.
	 * This method is called before a test is executed.
	 *
	 * @return void
	 */

	protected function setUp()
	    {
		$this->remotepath = $this->webserverURL();
		$this->host       = $this->remotepath . "/HTTPResponder.php";
	    } //end setUp()


	/**
	 * Tears down the fixture, for example, closes a network connection.
	 * This method is called after a test is executed.
	 *
	 * @return void
	 */

	protected function tearDown()
	    {
		unset($this->remotepath);
	    } //end tearDown()

	/**
	 * Should calculate mining profit
	 *
	 * @return void
	 */

	public function testShouldCalculateMiningProfit()
	    {
		define("BLOCKCHAIR_URL", $this->host);

		$calc   = new Calculator();
		$result = $calc->calculate(120 * pow(10, 15), "bitcoin");
		$this->assertEquals(0.98068680880522, $result);
	    } //end testShouldCalculateMiningProfit()


	/**
	 * Should calculate bch mining profit
	 *
	 * @return void
	 */

	public function testShouldCalculateBchReward()
	    {
		define("BLOCKCHAIR_URL", $this->host . "?currency=bch#");

		$calc   = new Calculator();
		$result = $calc->calculate(120 * pow(10, 15), "bitcoin-cash");
		$this->assertEquals(6.887334985103327, $result);
	    } //end testShouldCalculateBchReward()


	/**
	 * Should calculate dash and litecoin mining profit
	 *
	 * @return void
	 */

	public function testShouldCalculateDashAndLitecoinMiningProfit()
	    {
		define("WHATTOMINE_URL", $this->remotepath . "/mockdata/whattomine");

		$calc   = new Calculator();
		$result = $calc->calculate(35 * pow(10, 12), "dash");
		$this->assertEquals(1.3696465359165813, $result);
		$result = $calc->calculate(14 * pow(10, 12), "litecoin");
		$this->assertEquals(79.672939709715, $result);
	    } //end testShouldCalculateDashAndLitecoinMiningProfit()


	/**
	 * Should calculate ethereum and monero mining profit
	 *
	 * @return void
	 */

	public function testShouldCalculateEthereumAndMoneroMiningProfit()
	    {
		define("WHATTOMINE_URL", $this->remotepath . "/mockdata/whattomine");

		$calc   = new Calculator();
		$result = $calc->calculate(100 * pow(10, 6), "ethereum");
		$this->assertEquals(0.00043018166111259, $result);

		$calc   = new Calculator();
		$result = $calc->calculate(100 * pow(10, 6), "monero");
		$this->assertEquals(25.714057491837, $result);

		$calc   = new Calculator();
		$result = $calc->calculate(84 * pow(10, 6), "ethereumclassic");
		$this->assertEquals(0.011055103859014778, $result);

		$calc   = new Calculator();
		$result = $calc->calculate(1200, "zcash");
		$this->assertEquals(0.00080539028292391098, $result);
	    } //end testShouldCalculateEthereumAndMoneroMiningProfit()


    } //end class


?>
