<?php
/**
 * Created by PhpStorm.
 * User: scott.henscheid
 * Date: 6/6/2016
 * Time: 2:08 PM
 */

namespace Staple\Tests;

use Staple\Session\Session;

class SessionTest extends \PHPUnit_Framework_TestCase
{
	public function testSessionStart()
	{
		//Setup
		Session::start(NULL,true);
		session_id('sessionid');

		//Act
		$id = session_id();

		//Assert
		$this->assertNotNull($id);
		$this->assertNotEmpty($id);
	}
}