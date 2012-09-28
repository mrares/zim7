<?php
namespace Zimt\WebBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Acme\UserBundle\Entity\User
 *
 * @ORM\Table(name="site_users")
 * @ORM\Entity(repositoryClass="Zimt\WebBundle\Entity\UserRepository")
 */
class User implements UserInterface
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=25, unique=true)
     */
    private $username = null;

    /**
     * @ORM\Column(type="string", length=32)
     */
    private $salt;

    /**
     * @ORM\Column(type="string", length=40)
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=60, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(name="is_active", type="boolean")
     */
    private $isActive;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $groups = 'ROLE_USER';

    public function __construct() {
        $this->isActive = true;
        $this->salt = md5(uniqid(null, true));
    }

    /**
     * @inheritDoc
     */
    public function getUsername() {
        return $this->username;
    }

    /**
     * @inheritDoc
     */
    public function setUsername($username) {
        if ($username === null) {
            $this->username = $username;
        }
        else {
            throw new \Exception("Entity username cannot change");
        }
    }

    /**
     * Get users email
     */
    public function getEmail() {
        return $this->email;
    }

    /**
     * Set users email address
     * @todo Validate email address format
     * @param string $email
     */
    public function setEmail($email) {
        $this->email = $email;
    }

    /**
     * @inheritDoc
     */
    public function getSalt() {
        return $this->salt;
    }

    /**
     * @inheritDoc
     */
    public function getPassword() {
        return $this->password;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    /**
     * @inheritDoc
     */
    public function getRoles() {
        return explode('|', $this->groups);
    }

    /**
     * Set all user roles
     *
     * @param string|array $roles
     * @throws \InvalidArgumentException
     */
    public function setRole($roles) {
        if (!is_array($roles) && !is_string($roles)) {
            throw new \InvalidArgumentException(
                    "Roles can only be set as array or '|' delimited string");
        }

        if (is_string($roles)) {
            $roles = explode('|', $roles);
        }

        foreach ($roles as $role) {
            if (!preg_match('/^[a-zA-Z0-0_.]$/', $role)) {
                throw new \InvalidArgumentException(
                        "Roles can only contain a-z 0-9 and _!");
            }
        }

        $this->groups = join('|', $roles);
    }

    /**
     * Add a role to the user
     *
     * @param string $role
     * @throws \InvalidArgumentException
     */
    public function addRole($role) {
        if (!preg_match('/^[a-zA-Z0-0_.]$/', $role)) {
            throw new \InvalidArgumentException(
                    "Roles can only contain a-z 0-9 and _!");
        }

        $roles = explode('|', $this->groups);
        if (!in_array($role, $roles)) {
            $roles[] = $role;
        }
        $this->groups = join('|', $roles);
    }

    /**
     * Remove a role from the user
     *
     * @param string $role
     */
    public function removeRole($role) {
        $roles = explode('|', $this->groups);
        if (in_array($role, $roles)) {
            unset($roles[$role]);
        }
        $this->groups = join('|', $roles);
    }

    /**
     * @inheritDoc
     */
    public function eraseCredentials() {}

}
