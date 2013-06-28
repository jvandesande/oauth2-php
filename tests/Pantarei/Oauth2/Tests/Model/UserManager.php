<?php

/**
 * This file is part of the pantarei/oauth2 package.
 *
 * (c) Wong Hoi Sing Edison <hswong3i@pantarei-design.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Pantarei\Oauth2\Tests\Model;

use Doctrine\ORM\EntityRepository;
use Pantarei\Oauth2\Model\ModelManagerInterface;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

/**
 * UserManager
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class UserManager extends EntityRepository implements UserProviderInterface, ModelManagerInterface
{
    public function getClass()
    {
        return $this->getClassName();
    }

    public function createUser()
    {
        $class = $this->getClass();
        return new $class();
    }

    public function deleteUser(UserInterface $user)
    {
        $this->getEntityManager()->remove($user);
        $this->getEntityManager()->flush();
    }

    public function reloadUser(UserInterface $user)
    {
        $this->getEntityManager()->refresh($user);
    }

    public function updateUser(UserInterface $user)
    {
        $this->getEntityManager()->persist($user);
        $this->getEntityManager()->flush();
    }

    public function loadUserByUsername($username)
    {
        $result = $this->findOneBy(array(
            'username' => $username,
        ));
        if ($result === null) {
            throw new UsernameNotFoundException();
        }

        return $result;
    }

    public function refreshUser(UserInterface $user)
    {
        $class = get_class($user);
        if (!$this->supportsClass($class)) {
            throw new UnsupportedUserException();
        }

        return $this->find($user->getId());
    }

    public function supportsClass($class)
    {
        return $this->getEntityName() === $class
            || is_subclass_of($class, $this->getEntityName());
    }
}