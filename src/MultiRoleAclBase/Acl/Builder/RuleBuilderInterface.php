<?php

namespace MultiRoleAclBase\Acl\Builder;

use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Permissions\Acl\Acl;

interface RuleBuilderInterface {

	/**
	 * function sets all the rules in $acl based on available rutes and roles
	 * Optional this function can also do all the resource and role-building at once.
	 *
	 * @param Acl $Acl        	
	 */
	public function buildRules(Acl $Acl, ServiceLocatorInterface $serviceLocator);

}
