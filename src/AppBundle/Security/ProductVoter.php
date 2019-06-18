<?php


namespace AppBundle\Security;

use AppBundle\Entity\User;
use AppBundle\Entity\Product;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\AccessDecisionManagerInterface;

class ProductVoter extends Voter
{
    const VIEW = 'view';
    const EDIT = 'edit';

    private $decisionManager;

    public function __construct(AccessDecisionManagerInterface $decisionManager)
    {
        $this->decisionManager = $decisionManager;
    }


    protected function supports($attribute, $subject)
    {
        if (!in_array($attribute, array(self::VIEW, self::EDIT))) {
            return false;
        }

        if (!$subject instanceof Product) {
            return false;
        }
        return true;
    }

    protected function voteOnAttribute($attribute, $subject, TokenInterface $token)
    {
        $user = $token->getUser();

        if (!$user instanceof User) {
            return false;
        }

        /** @var Product $product */
        $product = $subject;

        switch ($attribute) {
            case self::VIEW:
                return $this->canView($product, $user, $token);
            case self::EDIT:
                return $this->canEdit($product, $user, $token);
        }

        throw new \LogicException('This code should not be reached!');
    }

    private function canView(Product $product, User $user, TokenInterface $token)
    {
        if ($this->canEdit($product, $user, $token)) {
            return true;
        }

        return $user === $product->getUser();
    }

    private function canEdit(Product $product, User $user, TokenInterface $token)
    {
        if ($this->decisionManager->decide($token, array('ROLE_GLOBAL_ADMIN'))) {
            return true;
        }

        return $user === $product->getUser();
    }



}