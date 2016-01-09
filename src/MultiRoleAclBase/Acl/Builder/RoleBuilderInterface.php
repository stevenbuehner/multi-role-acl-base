<?php

namespace MultiRoleAclBase\Acl\Builder;

use Zend\Permissions\Acl\AclInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

interface RoleBuilderInterface {

	/**
	 * function sets all the roles in $acl that are used later on in ruleBuilder
	 *
	 * @param AclInterface $Acl        	
	 * @return array of all roles (optional. set all roles in $acl right away)
	 */
	public function buildRoles(AclInterface $Acl, ServiceLocatorInterface $serviceLocator);

}
