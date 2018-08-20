<?php

use PHPUnit\Framework\TestCase;
require_once 'core.php';

/**
* Series of test classes for the core.php module
* 
* @uses PHPUnit\Framework\TestCase
* 
* @author Oli Radlett <o.radlett@gmail.com>
* @since Commit 91 - 20/08/18 
* 
*/
class UserTest extends TestCase {

	/**
	* Test functions to test the User Class
	* 
 	* @author Oli Radlett <o.radlett@gmail.com>
 	* @since Commit 91 - 20/08/18 
 	* 
 	*/

	var $user;
 
 	// Called before tests are run
	function setUp() {

		/**
		* Used to declare all objects and variables used in tests
		* 
		* @return void
		* 
		* @author Oli Radlett <o.radlett@gmail.com>
		* @since Commit 91 - 20/08/18 
		* 
		*/

		// Init new User object
		$this->user = new User("testUsername", "testPassword", "testFirstName", "testLastName", "testEmailAddress");

	}

	// Called after all tests have ran
	function tearDown() {

		/**
		* Used to unset all objects created during tests
		* 
		* @return void
		* 
		* @author Oli Radlett <o.radlett@gmail.com>
		* @since Commit 91 - 20/08/18 
		* 
		*/

		unset($user);

	}

	function testVerifyMatchingHash() {

		/**
		* 
		* @test
		* 
		* Test to check a password can be verified against the hash stored in the User object
		*
		* @return void 
		* 
		* @author Oli Radlett <o.radlett@gmail.com>
		* @since Commit 91 - 20/08/18 
		* 
		* @covers User::verifyHash
		* @uses this->user
		* 
		*/

		$result = $this->user->verifyHash("testPassword");
		$expected = true;
		$this->assertSame($result, $expected);

	}

	function testVerifyNonMatchingHash() {

		/**
		* 
		* @test
		* 
		* Test to check that the User object does not verify a non-matching password to it's current password hash attribute
		*
		* @return void 
		* 
		* @author Oli Radlett <o.radlett@gmail.com>
		* @since Commit 91 - 20/08/18 
		* 
		* @covers User::verifyHash
		* @uses this->user
		* 
		*/

		$result = $this->user->verifyHash("nonMatchingPassword");
		$expected = false;
		$this->assertSame($result, $expected);

	}

}