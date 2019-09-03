<?php

namespace AppBundle\Service\Business;

use Symfony\Component\Translation\TranslatorInterface;

class RoleBusiness
{
    private $rolesHierarchy;

    private $translator;

    public function __construct(TranslatorInterface $translator, $rolesHierarchy)
    {
        $this->rolesHierarchy = $rolesHierarchy;
        $this->translator = $translator;
    }

    public function getRoles()
    {
        $roles = [];

        foreach ($this->rolesHierarchy as $role => $subRoles) {
            $mainRole = $this->translator->trans($role, [], 'role');
            foreach ($subRoles as $subRole) {
                if (array_key_exists($subRole, $this->rolesHierarchy)) {
                    continue;
                }

                if(!isset($roles[$mainRole])) {
                    $roles[$mainRole] = [];
                }
                $roles[$mainRole][$this->translator->trans($subRole, [], 'role')] = $subRole;
            }
        }

        return $roles;
    }
}
