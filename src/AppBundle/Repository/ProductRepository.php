<?php


namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

class ProductRepository extends EntityRepository
{
    public function findAllForCount()
    {
        $em = $this->getEntityManager();
        $query  = "SELECT SUM(price) as count_price, ";
        $query .= "COUNT(id) as count_id, ";
        $query .= "(SELECT name FROM product_category WHERE id = p.category_id) as category_name ";
        $query .= "FROM product AS p ";
        $query .= "GROUP BY category_id";

        $data = $em->getConnection()->prepare($query);
        $data->execute();
        return $data->fetchAll();
    }
}