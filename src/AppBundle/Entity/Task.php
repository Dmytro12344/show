<?php


namespace AppBundle\Entity;

use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Type;
use Symfony\Component\Validator\Mapping\ClassMetadata;

class Task
{
    protected $task;
    protected $dueDate;


    public function getTask()
    {
        return $this->task;
    }


    public function setTask($task)
    {
        $this->task = $task;
    }


    public function getDueDate()
    {
        return $this->dueDate;
    }


    public function setDueDate(\DateTime $dueDate = null)
    {
        $this->dueDate = $dueDate;
    }


    public function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraint('task', new NotBlank());
        $metadata->addPropertyConstraint('dueDate', new NotBlank());

        $metadata->addPropertyConstraint('duedate', new Type(\DateTime::class));
    }

}