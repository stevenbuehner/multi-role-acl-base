<?php

/**
 * (c) Ismael Trascastro <i.trascastro@gmail.com>
 *
 * @link        http://www.ismaeltrascastro.com
 * @copyright   Copyright (c) Ismael Trascastro. (http://www.ismaeltrascastro.com)
 * @license     MIT License - http://en.wikipedia.org/wiki/MIT_License
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace MultiRoleAclBase\Handler;

use Zend\Http\Response;
use Zend\Mvc\MvcEvent;
use Zend\Permissions\Acl\AclInterface;
use RoleInterfaces\Provider\RoleProviderInterface;

class RouteHandler {
	/**
	 *
	 * @var AclInterface
	 */
	private $acl;
	
	/**
	 *
	 * @var array
	 */
	private $config;
	
	/**
	 *
	 * @var RoleProviderInterface
	 */
	private $roleProvider;
	
	/**
	 *
	 * @var unknown
	 */
	private $resourceProvider;

	/**
	 *
	 * @param AclInterface $acl        	
	 * @param array $config        	
	 * @param RoleProviderInterface $roleProvider        	
	 */
	function __construct(AclInterface $acl, $config, RoleProviderInterface $roleProvider) {
		$this->acl = $acl;
		$this->config = $config;
		$this->roleProvider = $roleProvider;
	}

	/**
	 * handler
	 *
	 * Handles MvcEvent::EVENT_ROUTE
	 *
	 * @param MvcEvent $event        	
	 */
	public function handler(MvcEvent $event) {
		$match = $event->getRouteMatch ();
		
		if (! $match) { // we need a route
			return;
		}
		
		$roles = $this->roleProvider->getRoles ();
		
		if (! $this->acl->isAllowed ( $roles, $match->getMatchedRouteName () )) {
			$controller = $this->config ['MultiRoleAclBase'] ['forbidden'] ['controller'];
			$action = $this->config ['MultiRoleAclBase'] ['forbidden'] ['action'];
			$response = $event->getResponse ();
			
			$response->setStatusCode ( Response::STATUS_CODE_403 ); // Forbidden
			$match->setParam ( 'controller', $controller );
			$match->setParam ( 'action', $action );
		}
		
		// we make the acl available on views
		$event->getViewModel ()->setVariable ( 'tacl', $this->acl );
	}

}
