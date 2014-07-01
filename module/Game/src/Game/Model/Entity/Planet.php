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
     * @var int $id
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string $name
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    private $name;

    /**
    * @var User $owner
    * @ORM\ManyToOne(targetEntity="Auth\Model\Entity\User", inversedBy="planets")
    */
    private $owner;

    /**
     * @var int $galaxy
     * @ORM\Column(type="integer", nullable=false)
     */
    private $galaxy;

    /**
     * @var int $system
     * @ORM\Column(type="integer", nullable=false)
     */
    private $system;

    /**
     * @var int $planet
     * @ORM\Column(type="integer", nullable=false)
     */
    private $planet;

    /**
     * @var int $type
     * @ORM\Column(type="integer", nullable=false)
     */
    private $type;

    /**
     * @var \DateTime $destroyed
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $destroyed;

    /**
     * @var int $diameter
     * @ORM\Column(type="integer", nullable=false)
     */
    private $diameter;

    /**
     * @var int $fields
     * @ORM\Column(type="integer", nullable=false)
     */
    private $fields;

    /**
     * @var int $fieldsMax
     * @ORM\Column(type="integer", nullable=false)
     */
    private $fieldsMax;

    /**
     * @var int $tempMin
     * @ORM\Column(type="integer", nullable=false)
     */
    private $tempMin;

    /**
     * @var int $tempMax
     * @ORM\Column(type="integer", nullable=false)
     */
    private $tempMax;

    /**
     * @param array $options
     */
    public function __construct(array $options = array())
    {
        $this->name      = 'Home planet';
        $this->type      = 1;
        $this->diameter  = 12800;
        $this->fields    = 0;
        $this->fieldsMax = 163;
        $this->tempMax   = 23;
        $this->tempMax   = -17;
        $this->galaxy    = 1;
        $this->system    = 1;
        $this->planet    = 3;

        if (!empty($options)) {
            foreach ($options as $key => $value) {
                $func = 'set'.$key;
                $this->$func($value);
            }
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

    /**
     * @param \DateTime $destroyed
     */
    public function setDestroyed($destroyed)
    {
        $this->destroyed = $destroyed;
    }

    /**
     * @return \DateTime
     */
    public function getDestroyed()
    {
        return $this->destroyed;
    }

    /**
     * @param int $diameter
     */
    public function setDiameter($diameter)
    {
        $this->diameter = $diameter;
    }

    /**
     * @return int
     */
    public function getDiameter()
    {
        return $this->diameter;
    }

    /**
     * @param int $fields
     */
    public function setFields($fields)
    {
        $this->fields = $fields;
    }

    /**
     * @return int
     */
    public function getFields()
    {
        return $this->fields;
    }

    /**
     * @param int $fieldsMax
     */
    public function setFieldsMax($fieldsMax)
    {
        $this->fieldsMax = $fieldsMax;
    }

    /**
     * @return int
     */
    public function getFieldsMax()
    {
        return $this->fieldsMax;
    }

    /**
     * @param int $galaxy
     */
    public function setGalaxy($galaxy)
    {
        $this->galaxy = $galaxy;
    }

    /**
     * @return int
     */
    public function getGalaxy()
    {
        return $this->galaxy;
    }

    /**
     * @param int $planet
     */
    public function setPlanet($planet)
    {
        $this->planet = $planet;
    }

    /**
     * @return int
     */
    public function getPlanet()
    {
        return $this->planet;
    }

    /**
     * @param int $system
     */
    public function setSystem($system)
    {
        $this->system = $system;
    }

    /**
     * @return int
     */
    public function getSystem()
    {
        return $this->system;
    }

    /**
     * @param int $tempMax
     */
    public function setTempMax($tempMax)
    {
        $this->tempMax = $tempMax;
    }

    /**
     * @return int
     */
    public function getTempMax()
    {
        return $this->tempMax;
    }

    /**
     * @param int $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return int
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param int $tempMin
     */
    public function setTempMin($tempMin)
    {
        $this->tempMin = $tempMin;
    }

    /**
     * @return int
     */
    public function getTempMin()
    {
        return $this->tempMin;
    }

}
