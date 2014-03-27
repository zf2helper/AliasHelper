<?php
namespace AliasHelper\Model;

class Alias
{
    public function __construct(\Doctrine\ORM\EntityManager $em)
    {
        $this->em = $em;
    }
    
    public function setAlias($entity, $field = null)
    {
        $class = get_class($entity);
        if ($field) {
            $function = 'get'.ucfirst($field);
            $aliasName = $name = \AliasHelper\Services\Alias::stringToAlias($entity->$function());
        } else {
            $aliasName = $name = \AliasHelper\Services\Alias::stringToAlias($entity->getTitle());
        }
        $i = 0;
        while (true) {
            if ($i > 0)
                $aliasName = $name . '-' . $i;

            $query = $this->em->createQueryBuilder()
                ->select("COUNT(c)")
                ->from($class, 'c')
                ->where('c.alias = \'' . $aliasName . '\'')
                ->getQuery();

            $count = $query->getSingleResult(4);
            if ($count == 0) {
                break;
            } elseif ($count == 1){
                $self = $this->em->getRepository($class)->findOneByAlias($aliasName);
                if ($self->getId() === $entity->getId()) break;
            }
            $i++;
        }
        //$entity->setAlias($aliasName);
        
        return $aliasName;
    }
}
