<?php

namespace Cekurte\TwitterLike\Entity;

use Cekurte\ResourceManager\Contract\ResourceInterface;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use JMS\Serializer\Annotation as JMS;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Post
 *
 * @ORM\Table(
 *     name="post",
 *     uniqueConstraints={
 *         @ORM\UniqueConstraint(name="id_UNIQUE", columns={"id"})
 *     }
 * )
 * @ORM\Entity(repositoryClass="Cekurte\TwitterLike\Entity\Repository\PostRepository")
 * @JMS\AccessorOrder("custom", custom={"id", "createdAt", "message"})
 */
class Post implements ResourceInterface
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     *
     * @JMS\Type("integer")
     * @JMS\XmlAttribute
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="message", type="string", length=140, nullable=false)
     *
     * @Assert\Type(type="string")
     * @Assert\NotBlank()
     * @Assert\Length(
     *      min = 1,
     *      max = 140,
     *      minMessage = "Your message must be at least {{ limit }} characters long",
     *      maxMessage = "Your message cannot be longer than {{ limit }} characters"
     * )
     *
     * @JMS\Type("string")
     * @JMS\XmlValue
     */
    private $message;

    /**
     * @var string
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     *
     * @Gedmo\Timestampable(on="create")
     *
     * @JMS\Type("DateTime<'Y-m-d H:i:s'>")
     * @JMS\XmlAttribute
     */
    private $createdAt;

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
     * Set message
     *
     * @param string $message
     *
     * @return Post
     */
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Get message
     *
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Post
     */
    public function setCreatedAt(\DateTime $createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }
}
