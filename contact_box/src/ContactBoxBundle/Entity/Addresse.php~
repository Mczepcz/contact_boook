<?php

namespace ContactBoxBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Addresse
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="ContactBoxBundle\Entity\AddresseRepository")
 */
class Addresse
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="city", type="string", length=255)
     */
    private $city;

    /**
     * @var string
     *
     * @ORM\Column(name="street", type="string", length=255)
     */
    private $street;

    /**
     * @var integer
     *
     * @ORM\Column(name="houseNo", type="integer")
     */
    private $houseNo;

    /**
     * @var integer
     *
     * @ORM\Column(name="apartmentNo", type="integer")
     */
    private $apartmentNo;
    
    /**
     * @ORM\ManyToOne(targetEntity="ContactBoxBundle\Entity\Contact", inversedBy="addresses")
     * @var Contact
     */
    private $contact;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set city
     *
     * @param string $city
     * @return Addresse
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return string 
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set street
     *
     * @param string $street
     * @return Addresse
     */
    public function setStreet($street)
    {
        $this->street = $street;

        return $this;
    }

    /**
     * Get street
     *
     * @return string 
     */
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * Set houseNo
     *
     * @param integer $houseNo
     * @return Addresse
     */
    public function setHouseNo($houseNo)
    {
        $this->houseNo = $houseNo;

        return $this;
    }

    /**
     * Get houseNo
     *
     * @return integer 
     */
    public function getHouseNo()
    {
        return $this->houseNo;
    }

    /**
     * Set apartmentNo
     *
     * @param integer $apartmentNo
     * @return Addresse
     */
    public function setApartmentNo($apartmentNo)
    {
        $this->apartmentNo = $apartmentNo;

        return $this;
    }

    /**
     * Get apartmentNo
     *
     * @return integer 
     */
    public function getApartmentNo()
    {
        return $this->apartmentNo;
    }

    /**
     * Set contact
     *
     * @param \ContactBoxBundle\Entity\Contact $contact
     * @return Addresse
     */
    public function setContact(\ContactBoxBundle\Entity\Contact $contact = null)
    {
        $this->contact = $contact;

        return $this;
    }

    /**
     * Get contact
     *
     * @return \ContactBoxBundle\Entity\Contact 
     */
    public function getContact()
    {
        return $this->contact;
    }
}
