<?php

/**
 * 
 * (c) Steven Bühner <buehner@me.com>

 * @author Steven Bühner
 * @license MIT
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 * 
 * The implementation of this interface provides the acl with a resource and priviledge so it can match the User / Role against it
 */
namespace MultiRoleAclBase\Handler\Provider;

use Zend\Mvc\MvcEvent;
interface ResourceProviderInterface {

	/**
	 *
	 * @return string
	 */
	public function getResource(MvcEvent $e);

	/**
	 *
	 * @return string
	 */
	public function getPriviledge(MvcEvent $e);

}
