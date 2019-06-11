<?php


namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\Collection;




/**
 * @ORM\Entity
 * @ORM\Table(name="product")
 */
class Product
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     * @Assert\NotBlank()
     */
    private $name;

    /**
     * @ORM\Column(type="decimal", scale=2)
     * @Assert\GreaterThan(value="0", message="Field Price must be greater then 0")
     * @Assert\Type("numeric", message="Field Price must be number")
     * @Assert\NotBlank(message="Field Price be required")
     */
    private $price;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank(message="Field description be required")
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\ProductCategory", inversedBy="product")
     * @ORM\JoinColumn(nullable=true)
     * @Assert\NotBlank(message="Field category must be required")
     */
    private $category;

    /**
     * @return Collection|ProductCategory[]
     */
    public function getCategory()
    {
        return $this->category;
    }


    public function setCategory(ProductCategory $category) : void
    {
        $this->category = $category;
    }


    public function getId()
    {
        return $this->id;
    }


    public function getName()
    {
        return $this->name;
    }


    public function setName($name)
    {
        $this->name = $name;
    }


    public function getPrice()
    {
        return $this->price;
    }


    public function setPrice($price)
    {
        $this->price = $price;
    }


    public function getDescription()
    {
        return $this->description;
    }


    public function setDescription($description)
    {
        $this->description = $description;
    }


}