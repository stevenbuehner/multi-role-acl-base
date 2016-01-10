<?php

/** Parts of the code are from Ismael Trascastro <i.trascastro@gmail.com>
 * 
* @link        https://github.com/itrascastro/TrascastroACL
* @copyright   Copyright (c) Ismael Trascastro. (http://www.ismaeltrascastro.com), Steven B�hner
* @license     MIT License - http://en.wikipedia.org/wiki/MIT_License
* @author      Steven B�hner <buehner@me.com>
*/
namespace MultiRoleAclBase\Acl\Builder;

class DefaultResourceBuilder implements ResourceBuilderInterface {
	protected $acl;

	/**
	 * Every Route is a Resource
	 *
	 * @see \MultiRoleAclBase\Acl\Builder\ResourceBuilderInterface::buildResources()
	 */
	public function buildResources(Zend\Permissions\Acl\Acl $acl, \Zend\ServiceManager\ServiceLocatorInterface $serviceLocator) {
		$this->acl = $acl;
		$config = $serviceLocator->get ( 'config' );
		$routes = $config ['router'] ['routes'];
		
		foreach ( $routes as $route => $value ) {
			$this->parseRoute ( $route, $value );
		}
		
		return null;
	}

	/**
	 * parseRoute
	 *
	 * For each route
	 * - It has not a parent route
	 * - It has not child routes
	 * - It has child routes
	 * - It can be alone (may_terminate == true)
	 * - It can't be alone (may_terminate == false)
	 * - It has a parent route
	 * - It has not child routes
	 * - It has child routes
	 * - It can be alone (may_terminate == true)
	 * - It can't be alone (may_terminate == false)
	 *
	 * @param string $route        	
	 * @param array $value        	
	 * @param string $parent        	
	 */
	private function parseRoute($route, $value, $parent = null) {
		if (! $parent) {
			if (empty ( $value ['child_routes'] )) {
				$this->routeRolesToAcl ( $route, $value );
			} elseif ($value ['may_terminate']) {
				$this->routeRolesToAcl ( $route, $value );
				$this->iterateChildRoutes ( $route, $value );
			} else {
				$this->iterateChildRoutes ( $route, $value );
			}
		} else {
			$route = $parent . '/' . $route;
			
			if (empty ( $value ['child_routes'] )) {
				$this->routeRolesToAcl ( $route, $value );
			} elseif ($value ['may_terminate']) {
				$this->routeRolesToAcl ( $route, $value );
				$this->iterateChildRoutes ( $route, $value );
			} else {
				$this->iterateChildRoutes ( $route, $value );
			}
		}
	}

	/**
	 * routeRolesToAcl
	 *
	 * Creates an allow rule in Acl for that route and its allowed roles
	 *
	 * @param string $route        	
	 * @param array $value        	
	 */
	private function routeRolesToAcl($route, $value) {
		$this->acl->addResource ( $route );
		$routeRoles = ! empty ( $value ['options'] ['defaults'] ['roles'] ) ? $value ['options'] ['defaults'] ['roles'] : [ ];
		$this->acl->allow ( $routeRoles, $route );
	}

	/**
	 * iterateChildRoutes
	 *
	 * Iterates child routes for a given route parsing each child
	 *
	 * @param string $route        	
	 * @param array $value        	
	 */
	private function iterateChildRoutes($route, $value) {
		foreach ( $value ['child_routes'] as $childRoute => $childValue ) {
			$this->parseRoute ( $childRoute, $childValue, $route );
		}
	}

}
