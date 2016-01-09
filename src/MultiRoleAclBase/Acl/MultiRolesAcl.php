<?php

namespace MultiRoleAclBase\Acl;

use Zend\Permissions\Acl\Acl;

class MultiRolesAcl extends Acl {
	protected $allow_access_when_resource_unknown;

	/**
	 *
	 * @param bool $allow_access_when_resource_unknown        	
	 */
	public function __construct() {
		$this->allow_access_when_resource_unknown = false;
	}

	/**
	 * Override isAllowed function to also support multiple roles
	 *
	 * @see \Zend\Permissions\Acl\Acl::isAllowed()
	 * @param Role\RoleInterface|string|array $role        	
	 * @param Resource\ResourceInterface|string $resource        	
	 * @param string $privilege        	
	 * @return bool
	 */
	public function isAllowed($roles = NULL, $resource = NULL, $priviledge = NULL) {
		if (true === $this->allow_access_when_resource_unknown && ! $this->hasResource ( $resource ))
			return true;
		
		if (is_array ( $roles )) {
			foreach ( $roles as $role ) {
				if (true === parent::isAllowed ( $role, $resource, $priviledge ))
					return true;
			}
		} else {
			return parent::isAllowed ( $roles, $resource, $priviledge );
		}
		
		return false;
	}

}