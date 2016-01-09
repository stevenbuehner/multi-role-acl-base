<?php

/**
 * (c) Steven BŸhner <buehner@me.com>
 *
 * @license     MIT License - http://en.wikipedia.org/wiki/MIT_License
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace MultiRoleAclBase\Service\Factory;

use Zend\Permissions\Acl\Acl;

class AclServiceFactory {
	/**
	 *
	 * @var Acl
	 */
	protected $acl;
	
	/*
	 * @var $roleBuilder \MultiRoleAclBase\Acl\RoleBuilderInterface
	 */
	protected $roleBuilder;
	
	/**
	 *
	 * @var $resourceBuilder \MultiRoleAclBase\Acl\ResourceBuilderInterface
	 */
	protected $resourceBuilder;
	
	/**
	 *
	 * @var $ruleBuilder \MultiRoleAclBase\Acl\RuleBuilderInterface
	 */
	protected $ruleBuilder;

	public function __invoke($serviceLocator) {
		$config = $serviceLocator->get ( 'config' );
		
		$this->acl = $serviceLocator->get ( 'MultiRoleAclBase\Acl\MultiRolesAcl' );
		
		$this->roleBuilder = $serviceLocator->get ( 'MultiRoleAclBase\Acl\Builder\RoleBuilder' );
		$this->resourceBuilder = $serviceLocator->get ( 'MultiRoleAclBase\Acl\Builder\ResourceBuilder' );
		$this->ruleBuilder = $serviceLocator->get ( 'MultiRoleAclBase\Acl\Builder\RuleBuilder' );
		
		// Get all Roles from RoleBuilder
		$roles = $this->roleBuilder->buildRoles ( $this->acl, $serviceLocator );
		if (is_array ( $roles )) {
			foreach ( $roles as $role ) {
				$this->acl->addRole ( $role );
			}
		}
		
		// Get all Resources from ResourceBuilder
		$resources = $this->resourceBuilder->buildResources ( $this->acl, $serviceLocator );
		if (is_array ( $resources )) {
			foreach ( $resources as $resource ) {
				$this->acl->addResource ( $resource );
			}
		}
		
		// Build all the rules
		$this->ruleBuilder->buildRules ( $this->acl, $serviceLocator );
		
		return $this->acl;
	}
}
