<?php

use PHPUnit\Framework\TestCase;
require_once 'core.php';
require_once 'database.php';

/**
* Series of test classes for the User class
* 
* @uses PHPUnit\Framework\TestCase
* 
* @author Oli Radlett <o.radlett@gmail.com>
* @since Commit 91 - 20/08/18 
* 
*/
class UtilTest extends TestCase {

	/**
	* Test functions to test the User Class
	* 
 	* @author Oli Radlett <o.radlett@gmail.com>
 	* @since Commit 91 - 20/08/18 
 	* 
 	*/

 	var $database;

 	// Called before tests are run
 	function setUp() {

 		/**
		* Used to declare all objects and variables used in tests
		* 
		* @return void
		* 
		* @author Oli Radlett <o.radlett@gmail.com>
		* @since Commit 96 - 20/08/18 
		* 
		*/

 		$this->database = new Database();

 	}

 	// Called after tests are run
 	function tearDown() {

 		/**
		* Used to unset all objects created during tests
		* 
		* @return void
		* 
		* @author Oli Radlett <o.radlett@gmail.com>
		* @since Commit 96 - 20/08/18 
		* 
		*/

 		unset($this->database);

 	}

	function testIsIPBlocked() {

		/**
		* 
		* @test
		* 
		* Test to check that the Util::isIPBlocked function returns true if the provided address is stored in npe.blocke_ipaddr
		*
		* @return void 
		* 
		* @author Oli Radlett <o.radlett@gmail.com>
		* @since Commit 96 - 21/08/18 
		* 
		* @covers Util::isIPBlocked
		* @uses this->database
		* 
		*/


		$blockedAddress = "test.address";
		$result = Util::isIPBlocked($blockedAddress, $this->database);
		$expected = true;
		$this->assertSame($result, $expected);

 	}

 	function testIsNotIPBlocked() {

 		/**
		* 
		* @test
		* 
		* Test to check that the Util::isIpBlocked function returns false when an unblocked address is provided
		*
		* @return void 
		* 
		* @author Oli Radlett <o.radlett@gmail.com>
		* @since Commit 96 - 21/08/18 
		* 
		* @covers Util::isIPBlocked
		* @uses this->database
		* 
		*/


		$blockedAddress = "this.address.is.not.blocked";
		$result = Util::isIPBlocked($blockedAddress, $this->database);
		$expected = false;
		$this->assertSame($result, $expected);

 	}

 	function testIsset() {

 		/**
		* 
		* @test
		* 
		* Test to check that the Util::_isset function returns true if all provided parameters are filled
		*
		* @return void 
		* 
		* @author Oli Radlett <o.radlett@gmail.com>
		* @since Commit 96 - 21/08/18 
		* 
		* @covers Util::_isset
		* 
		*/


 		$result = Util::_isset("test", "test", "test");
 		$expected = true;
 		$this->assertSame($result, $expected);

 	}

 	function testNotIsset() {

 		/**
		* 
		* @test
		* 
		* Test to check that the Util::_isset function does not return true if a parameter is NULL
		*
		* @return void 
		* 
		* @author Oli Radlett <o.radlett@gmail.com>
		* @since Commit 96 - 21/08/18 
		* 
		* @covers Util::_isset
		* 
		*/


 		$result = Util::_isset("test", NULL, "test");
 		$expected = false;
 		$this->assertSame($result, $expected);

 	}

 	function testEmailValid() {

 		/**
		* 
		* @test
		* 
		* Test to check that the Util::emailValid function can validate email addresses
		*
		* @return void 
		* 
		* @author Oli Radlett <o.radlett@gmail.com>
		* @since Commit 96 - 21/08/18 
		* 
		* @covers Util::emailValid
		* 
		*/


 		$result = Util::emailValid("test@test.com");
 		$expected = true;
 		$this->assertSame($result, $expected);

 	}

 	function testNotEmailValid() {

 		/**
		* 
		* @test
		* 
		* Test to check that the Util::emailValid function does not validate Strings that are not valid email addresses
		*
		* @return void 
		* 
		* @author Oli Radlett <o.radlett@gmail.com>
		* @since Commit 96 - 21/08/18 
		* 
		* @covers Util::emailValid
		* 
		*/

 		$result = Util::emailValid("test");
 		$expected = false;
 		$this->assertSame($result, $expected);

 	}

 }