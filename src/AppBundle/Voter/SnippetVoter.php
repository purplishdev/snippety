<?php

namespace AppBundle\Voter;

use AppBundle\Entity\Snippet;
use AppBundle\Entity\User;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\User\UserInterface;

class SnippetVoter extends Voter {

    const VIEW = 'view';
    const EDIT = 'edit';
    const DELETE = 'delete';

    protected function supports($attribute, $subject) {
        if (!in_array($attribute, array(self::VIEW, self::EDIT, self::DELETE))) {
            return false;
        }

        if (!$subject instanceof Snippet) {
            return false;
        }

        return true;
    }

    protected function voteOnAttribute($attribute, $snippet, TokenInterface $token) {

        $user = $token->getUser();

        if ($user instanceof UserInterface) {
            if (in_array('ROLE_SUPER_ADMIN', $user->getRoles())) {
                return self::ACCESS_GRANTED;
            }
        }

        switch ($attribute) {
            case self::VIEW:
                return $this->isAnonymousViewer($user) || $this->canView($snippet, $user);
            case self::EDIT:
                return $this->canEdit($snippet, $user);
            case self::DELETE:
                return $this->canDelete($snippet, $user);
            default:
                return self::ACCESS_DENIED;
        }
    }

    private function isAnonymousViewer($user) {
        if (!($user instanceof User) && $user === "anon.") {
            return true;
        }
    }

    private function canView(Snippet $snippet, User $user) {

        if ($this->canEdit($snippet, $user)) {
            return self::ACCESS_GRANTED;
        }

        return !$snippet->isPrivate();
    }

    private function canEdit(Snippet $snippet, User $user) {
        return $this->isAuthor($snippet, $user);
    }

    private function canDelete(Snippet $snippet, User $user) {
        return $this->isAuthor($snippet, $user);
    }

    private function isAuthor(Snippet $snippet, User $user) {
        return $user->getId() === $snippet->getAuthor()->getId();
    }
}