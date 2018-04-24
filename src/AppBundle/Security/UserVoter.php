<?php

namespace AppBundle\Security;

use AppBundle\Entity\User;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

class UserVoter extends Voter
{
    const CREATE = 'create';
    const VIEW = 'view';
    const EDIT = 'edit';
    const DELETE = 'delete';

    /**
     * @param string $attribute
     * @param mixed $subject
     * @return bool
     */
    protected function supports($attribute, $subject)
    {
        if (!in_array($attribute, [
            self::CREATE,
            self::VIEW,
            self::EDIT,
            self::DELETE
        ])) {
            return false;
        }

        if (!$subject instanceof User) {
            return false;
        }

        return true;
    }

    /**
     * @param string $attribute
     * @param mixed $subject
     * @param TokenInterface $token
     * @return bool
     */
    protected function voteOnAttribute($attribute, $subject, TokenInterface $token)
    {
        $user = $token->getUser();

        if (!$user instanceof User) {
            return false;
        }

        $currentUser = $subject;

        switch ($attribute) {
            case self::CREATE:  // we're currently not using it, but maybe we'll use it in future
                return $this->canCreate($currentUser, $user);

            case self::VIEW:
                return $this->canView($currentUser, $user);

            case self::EDIT:
                return $this->canEdit($currentUser, $user);

            case self::DELETE:
                return $this->canDelete($currentUser, $user);
        }

        throw new \LogicException('Incompatible Voter parameters.');
    }

    private function canCreate(User $currentUser, User $user)
    {
        return $user->getId() === $currentUser->getId();
    }

    private function canView(User $currentUser, User $user)
    {
        return $user->getId() === $currentUser->getId();
    }

    private function canEdit(User $currentUser, User $user)
    {
        return $user->getId() === $currentUser->getId();
    }

    private function canDelete(User $currentUser, User $user)
    {
        return $user->getId() === $currentUser->getId();
    }
}
