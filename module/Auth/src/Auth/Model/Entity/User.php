<?php
/**
 * Created by PhpStorm.
 * User: yhimenko
 * Date: 19.06.14
 * Time: 15:03
 * @author Yuriy. V. Yukhimenko
 */
namespace Auth\Model\Entity;

use Game\Model\Entity\Planet;
use ZfcUserDoctrineORM\Entity\User as ZfcUserEntity;
use ZfcRbac\Identity\IdentityInterface;
use Rbac\Role\HierarchicalRoleInterface;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * @ORM\Entity
 * @ORM\Table(name="users")
 */
class User extends ZfcUserEntity implements IdentityInterface
{

    /**
     * @var int
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     * @ORM\Column(type="string", length=255, unique=true, nullable=true)
     */
    protected $username;

    /**
     * @var string
     * @ORM\Column(type="string", unique=true, length=255)
     */
    protected $email;

    /**
     * @var string
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    protected $displayName;

    /**
     * @var string
     * @ORM\Column(type="string", length=128)
     */
    protected $password;

    /**
     * @var int
     */
    protected $state;

    /**
     * @var HierarchicalRole[]|Collection
     * @ORM\ManyToMany(targetEntity="HierarchicalRole")
     */
    private $roles;

    /**
     * @var Planet
     * @ORM\OneToOne(targetEntity="Game\Model\Entity\Planet")
     * @ORM\JoinColumn(name="main_planet_id", referencedColumnName="id")
     */
    private $mainPlanet;

    /**
     * @var Planet
     * @ORM\OneToOne(targetEntity="Game\Model\Entity\Planet")
     * @ORM\JoinColumn(name="current_planet_id", referencedColumnName="id")
     */
    private $currentPlanet;

    /**
     * @var Planet[]|Collection
     * @ORM\OneToMany(targetEntity="Game\Model\Entity\Planet", mappedBy="owner", fetch="EAGER")
     */
    private $planets;


    public function __construct()
    {
        $this->roles   = new ArrayCollection();
        $this->planets = new ArrayCollection();
    }

    /**
     * {@inheritDoc}
     */
    public function getRoles()
    {
        return $this->roles->toArray();
    }

    /**
     * Set the list of roles
     * @param Collection $roles
     */
    public function setRoles(Collection $roles)
    {
        $this->roles->clear();
        foreach ($roles as $role) {
            $this->roles[] = $role;
        }
    }

    /**
     * Add one role to roles list
     * @param  \Rbac\Role\HierarchicalRoleInterface $role
     */
    public function addRole(HierarchicalRoleInterface $role)
    {
        $this->roles[] = $role;
    }

    /**
     * @return array
     * Helper function
     */
    public function getArrayCopy()
    {
        return get_object_vars($this);
    }

    /**
     * Add one planet to planets list
     * @param  \Game\Model\Entity\Planet $planet
     */
    public function addPlanet(Planet $planet)
    {
        $this->planets[] = $planet;
    }

    /**
     * @param \Doctrine\Common\Collections\Collection $planets
     */
    public function setPlanets(Collection $planets)
    {
        $this->planets->clear();
        foreach ($planets as $planet) {
            $this->planets[] = $planet;
        }
    }

    /**
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPlanets()
    {
        return $this->planets->toArray();
    }
}
