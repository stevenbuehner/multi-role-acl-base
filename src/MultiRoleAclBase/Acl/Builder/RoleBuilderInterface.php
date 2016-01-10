<?php

namespace MultiRoleAclBase\Acl\Builder;

use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Permissions\Acl\Acl;

interface RoleBuilderInterface {

	/**
	 * function sets all the roles in $acl that are used later on in ruleBuilder
	 *
	 * @param Acl $Acl        	
	 * @return array of all roles (optional. set all roles in $acl right away)
	 */
	public function buildRoles(Acl $Acl, ServiceLocatorInterface $serviceLocator);

}
