<?php
/**
 * Created by PhpStorm.
 * User: yhimenko
 * Date: 30.06.14
 * Time: 12:38
 * @author Yuriy. V. Yukhimenko
 */

namespace Game\Model\Entity;

use Doctrine\ORM\Mapping as ORM;
use Auth\Model\Entity\User;

/**
 * Class Planet
 * @package Game\Model\Entity
 * @ORM\Entity
 * @ORM\Table(name="planets", indexes={@ORM\Index(name="gsp_idx", columns={"galaxy", "system", "planet"})})
 */
class Planet
{
    /**
     * @var int
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    private $name;

    /**
    * @var User $owner
    * @ORM\ManyToOne(targetEntity="Auth\Model\Entity\User", inversedBy="planets")
    */
    private $owner;

    /**
     * @var int
     * @ORM\Column(type="integer", nullable=false)
     */
    private $galaxy;

    /**
     * @var int
     * @ORM\Column(type="integer", nullable=false)
     */
    private $system;

    /**
     * @var int
     * @ORM\Column(type="integer", nullable=false)
     */
    private $planet;

    /**
     * @var int
     * @ORM\Column(type="integer", nullable=false)
     */
    private $type;

    /**
     * @param array $options
     */
    public function __construct(array $options = array())
    {
        if (empty($options)) {
            $this->name = 'Colony';
            $this->type = 1;
        } else {

        }
    }

    /** Getters/Setters */

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param \Auth\Model\Entity\User $owner
     */
    public function setOwner(User $owner)
    {
        $this->owner = $owner;
    }

    /**
     * @return \Auth\Model\Entity\User
     */
    public function getOwner()
    {
        return $this->owner;
    }
}
