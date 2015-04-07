<?php

// +----------------------------------------------------------------------+
// | Copyright 2015 10up Inc                                              |
// +----------------------------------------------------------------------+
// | This program is free software; you can redistribute it and/or modify |
// | it under the terms of the GNU General Public License, version 2, as  |
// | published by the Free Software Foundation.                           |
// |                                                                      |
// | This program is distributed in the hope that it will be useful,      |
// | but WITHOUT ANY WARRANTY; without even the implied warranty of       |
// | MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the        |
// | GNU General Public License for more details.                         |
// |                                                                      |
// | You should have received a copy of the GNU General Public License    |
// | along with this program; if not, write to the Free Software          |
// | Foundation, Inc., 51 Franklin St, Fifth Floor, Boston,               |
// | MA 02110-1301 USA                                                    |
// +----------------------------------------------------------------------+

namespace WPCC\Command;

use Symfony\Component\Yaml\Yaml;

/**
 * Creates default config, tests directory and sample suites. Use this command
 * to start building a test suite.
 *
 * @since 1.0.0
 * @category WPCC
 * @package Command
 */
class Bootstrap extends \Codeception\Command\Bootstrap {

	/**
	 * Creates acceptance suite.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 * @param string $actor The actor name.
	 */
	protected function createAcceptanceSuite( $actor = 'Acceptance' ) {
		$suiteConfig = array(
			'class_name' => $actor . $this->actorSuffix,
			'modules'    => array(
				'enabled' => array( 'PhpBrowser', 'WordPress', $actor . 'Helper' ),
				'config'  => array(
					'PhpBrowser' => array( 'url' => home_url() ),
				),
			),
		);

		$str = "# Codeception Test Suite Configuration\n\n";
		$str .= "# suite for acceptance tests.\n";
		$str .= "# perform tests in browser using the WebDriver or PhpBrowser.\n";
		$str .= "# If you need both WebDriver and PHPBrowser tests - create a separate suite.\n\n";

		$str .= Yaml::dump( $suiteConfig, 5 );
		$this->createSuite( 'acceptance', $actor, $str );
	}

}