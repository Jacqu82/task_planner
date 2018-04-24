<?php

namespace AppBundle\Security;

use AppBundle\Entity\Task;
use AppBundle\Entity\User;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\AccessDecisionManagerInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

class TaskVoter extends Voter
{
    private $decisionManager;

    public function __construct(AccessDecisionManagerInterface $decisionManager)
    {
        $this->decisionManager = $decisionManager;
    }

    const VIEW = 'view';
    const EDIT = 'edit';
    const DELETE = 'delete';

    protected function supports($attribute, $subject)
    {
        if (!in_array($attribute, [
            self::VIEW,
            self::EDIT,
            self::DELETE
        ])) {
            return false;
        }

        if (!$subject instanceof Task) {
            return false;
        }

        return true;
    }

    /**
     * @param string $attribute
     * @param TokenInterface $token
     * @return bool
     */
    protected function voteOnAttribute($attribute, $subject, TokenInterface $token)
    {
        // ROLE_ADMIN can do anything! The power!
        if ($this->decisionManager->decide($token, array('ROLE_ADMIN'))) {
            return true;
        }

        $user = $token->getUser();

        $task = $subject;

        switch ($attribute) {
            case self::VIEW:
                return $this->canView($task, $user);

            case self::EDIT:
                return $this->canEdit($task, $user);

            case self::DELETE:
                return $this->canDelete($task, $user);
        }

        throw new \LogicException('Incompatible Voter parameters.');
    }

    private function canView(Task $task, User $user)
    {
        return $task->getUser() && $user->getId() === $task->getUser()->getId();
    }

    private function canEdit(Task $task, User $user)
    {
        return $task->getUser() && $user->getId() === $task->getUser()->getId();
    }

    private function canDelete(Task $task, User $user)
    {
        return $task->getUser() && $user->getId() === $task->getUser()->getId();
    }
}
