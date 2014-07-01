<?php
/**
 * Created by PhpStorm.
 * User: ontario
 * Date: 7/1/14
 * Time: 12:30 AM
 */

namespace Game\Model\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Resource
 * @package Game\Model\Entity
 * @ORM\Entity
 * @ORM\Table(name="resource")
 */
class Resource
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
}
