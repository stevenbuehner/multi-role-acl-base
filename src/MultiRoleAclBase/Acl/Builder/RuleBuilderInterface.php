<?php

namespace MultiRoleAclBase\Acl\Builder;

use Zend\Permissions\Acl\AclInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

interface RuleBuilderInterface {

	/**
	 * function sets all the rules in $acl based on available rutes and roles
	 * Optional this function can also do all the resource and role-building at once.
	 *
	 * @param AclInterface $Acl        	
	 */
	public function buildRules(AclInterface $Acl, ServiceLocatorInterface $serviceLocator);

}
