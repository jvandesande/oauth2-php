<?php

/**
 * This file is part of the authbucket/oauth2 package.
 *
 * (c) Wong Hoi Sing Edison <hswong3i@pantarei-design.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AuthBucket\OAuth2\Tests\TestBundle\Entity;

use AuthBucket\OAuth2\Model\AccessTokenInterface;
use AuthBucket\OAuth2\Model\AccessTokenManagerInterface;
use Doctrine\ORM\EntityRepository;

/**
 * AccessTokenRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class AccessTokenRepository extends EntityRepository implements AccessTokenManagerInterface
{
    public function createAccessToken()
    {
        $class = $this->getClassName();

        return new $class();
    }

    public function deleteAccessToken(AccessTokenInterface $accessToken)
    {
        $this->getEntityManager()->remove($accessToken);
        $this->getEntityManager()->flush();
    }

    public function reloadAccessToken(AccessTokenInterface $accessToken)
    {
        $this->getEntityManager()->refresh($accessToken);
    }

    public function updateAccessToken(AccessTokenInterface $accessToken)
    {
        $this->getEntityManager()->persist($accessToken);
        $this->getEntityManager()->flush();
    }
}
