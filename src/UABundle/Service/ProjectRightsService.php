<?php

namespace UABundle\Service;

use KernelBundle\Entity\User;
use Symfony\Component\Security\Core\Authorization\AuthorizationChecker;
use UABundle\Entity\Project;

class ProjectRightsService
{

    private $authorizationChecker;

    public function __construct(AuthorizationChecker $authorizationChecker)
    {
        $this->authorizationChecker = $authorizationChecker;
    }

    public function userHasRights(User $user, Project $project)
    {

        if (true === $this->authorizationChecker->isGranted('ROLE_UA_SUPERADMIN')) {
            return true;
        }

        $userData = $user->getUserData();

        if (!isset($userData)) {
            return false;
        }

        foreach ($project->getManagers() as $manager) {
            if ($userData->getId() === $manager->getManager()->getId()) {
                return true;
            }
        }

        return false;
    }

}