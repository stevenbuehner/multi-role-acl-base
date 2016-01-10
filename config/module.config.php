<?php
return array (
		'service_manager' => array (
				'invokables' => array (
						'MultiRoleAclBase\Service\MultiRolesAcl' => 'MultiRoleAclBase\Service\MultiRolesAcl',
						'MultiRoleAclBase\Acl\Builder\RoleBuilder' => 'MultiRoleAclBase\Acl\Builder\DefaultRoleBuilder',
						'MultiRoleAclBase\Acl\Builder\ResourceBuilder' => 'MultiRoleAclBase\Acl\Builder\DefaultResourceBuilder',
						'MultiRoleAclBase\Acl\Builder\RuleBuilder' => 'MultiRoleAclBase\Acl\Builder\DefaultRuleBuilder' 
				),
				'factories' => array (
						'MultiRoleAclBase\Acl\Acl' => 'MultiRoleAclBase\Service\Factory\AclServiceFactory',
						'MultiRoleAclBase\Handler\RouteHandler' => 'MultiRoleAclBase\Handler\Factory\RouteHandlerFactory',
						'MultiRoleAclBase\Provider\AclRuleProvider' => 'MultiRoleAclBase\Provider\Factory\AclRuleProviderFactory' 
				),
				'controllers' => array (
						'invokables' => array () 
				) 
		),
		'view_helpers' => array (
				'factories' => array (
						'acl' => 'MultiRoleAclBase\View\Helper\Factory\AclHelperFactory' 
				) 
		) 
);
