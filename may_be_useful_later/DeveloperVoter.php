<?php
namespace App\Security;

use App\Entity\Developer;
use App\Entity\UserAuths;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

class DeveloperVoter extends Voter
{
    // these strings are just invented: you can use anything
    const VIEW = 'view';
    const EDIT = 'edit';

    protected function supports(string $attribute, $subject): bool
    {
        // if the attribute isn't one we support, return false
        if (!in_array($attribute, [self::VIEW, self::EDIT])) {
            return false;
        }

        // only vote on `Developer` objects
        if (!$subject instanceof Developer) {
            return false;
        }

        return true;
    }

    protected function voteOnAttribute(string $attribute, $subject, TokenInterface $token): bool
    {
        $user = $token->getUser();

        if (!$user instanceof UserAuths) {
            // the user must be logged in; if not, deny access
            return false;
        }

        // you know $subject is a Post object, thanks to `supports()`
        /** @var Developer $developer */
        $developer = $subject;

        switch ($attribute) {
            case self::VIEW:
                return $this->canView($developer, $user);
            case self::EDIT:
                return $this->canEdit($developer, $user);
        }

        throw new \LogicException('This code should not be reached!');
    }

    private function canView(Developer $developer, UserAuths $user): bool
    {
        // if they can edit, they can view
        if ($this->canEdit($developer, $user)) {
            return true;
        }

    }

    private function canEdit(Developer $developer, UserAuths $user): bool
    {
        return $user->getUserId() === $developer->getId();
    }
}
