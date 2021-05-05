<?php
namespace App\Security;

use App\Entity\Project;
use App\Entity\UserAuths;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

class ProjectVoter extends Voter
{
    // these strings are just invented: you can use anything
    const OWNER = 'owner';

    protected function supports(string $attribute, $subject): bool
    {
        // if the attribute isn't one we support, return false
        if (!in_array($attribute, [self::OWNER])) {
            return false;
        }

        // only vote on `Project` objects
        if (!$subject instanceof Project) {
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
        /** @var Project $project */
        $project = $subject;

        switch ($attribute) {
            case self::OWNER:
                return $this->owner($project, $user);
        }

        throw new \LogicException('This code should not be reached!');
    }


    private function owner( Project $project, UserAuths $user): bool
    {

        return $user->getUserId()===$project->getOwner();
    }
}
