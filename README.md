AliasHelper
===========

 Simple module that creates alias from any text field of the entity.

**How does it work:**

1. Gets from entity field to create alias (title by default).
2. Convert field to url friendly alias.
3. Searchs entity repository for this alias.
4. Adds "-number" if such alias exists.


**Usage**:


```
#!php

$entity = new Entity();
$aliasModel = $this->getServiceLocator()->get('AliasHelper');
//$field - entity field that must be converted to alias, title by default
$alias = $aliasModel->getAlias($entity, $field)

$entity->setAlias($alias);
```


