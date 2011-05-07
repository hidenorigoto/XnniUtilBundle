<?php
namespace Xnni\UtilBundle\Controller;

class ORMRepositoryController extends ORMController
{
    const ACTION_INPUT    = 'ACTION_INPUT';
    const ACTION_CONFIRM  = 'ACTION_CONFIRM';
    const ACTION_COMPLETE = 'ACTION_COMPLETE';

    /**
     *
     */
    private $entityClass;
    private $repositoryClass;
    private $formTypeClass;

    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();

        preg_match('/^(.*\\\)Controller\\\(.*)Controller$/i', get_class($this), $match);
        $this->setEntityClass(sprintf('%sEntity\%s', $match[1], $match[2]));
        $this->setRepositoryClass(sprintf('%sRepository\%sRepository', $match[1], $match[2]));
        $this->setFormTypeClass(sprintf('%sForm\%sType', $match[1], $match[2]));
    }

    /**
     * Action 'list'
     */
    public function listAction()
    {
        $list = $this->getRepository()->findAll();
        return array('list'=>$list);
    }

    /**
     * Action 'show'
     */
    public function showAction($slug)
    {
        $item = $this->getRepository()->findOneBySlug($slug);
        return array('item'=>$item);
    }

    /**
     * Action 'new'
     */
    public function newAction()
    {
        $formTypeClass = $this->getFormTypeClass();
        $form = $this->get('form.factory')->create(new $formTypeClass);
        $entity = $this->createNewEntity();
        $form->setData($entity);

        $request = $this->get('request');
        if ('POST' === $request->getMethod()) {
            $form->bindRequest($request);

            if ($form->isValid()) {
                $topic = $form->getNormData();
                $this->em->persist($entity);
                $this->em->flush();

                return self::ACTION_COMPLETE;
            }
        }

        return array('form' => $form->createView());
    }

    /**
     * Gets the repository object related to the entity
     *
     * @return Repository object (extends Doctrine\ORM\EntityRepository)
     */
    public function getRepository()
    {
        return $this->em->getRepository($this->getEntityClass());
    }

    /**
     * Gets the entity class name (FQDN)
     *
     * @return string
     */
    public function getEntityClass()
    {
        return $this->entityClass;
    }

    /**
     * Sets the entity class name (FQDN)
     *
     * @param string $entityClass
     */
    public function setEntityClass($entityClass)
    {
        $this->entityClass = $entityClass;
    }

    /**
     * Gets the repository class name (FQDN)
     *
     * @return string
     */
    public function getRepositoryClass()
    {
        return $this->repositoryClass;
    }

    /**
     * Sets the repository class name (FQDN)
     *
     * @param string $repositoryClass
     */
    public function setRepositoryClass($repositoryClass)
    {
        $this->repositoryClass = $repositoryClass;
    }

    /**
     * Create the new entity object
     *
     * @return entity object
     */
    public function createNewEntity()
    {
        $class = $this->getEntityClass();
        return new $class();
    }

    /**
     * Gets the FormType class name (FQDN)
     *
     * @return string
     */
    public function getFormTypeClass()
    {
        return $this->formTypeClass;
    }

    /**
     * Sets the FormType class name (FQDN)
     *
     * @param string $formTypeClass
     */
    public function setFormTypeClass($formTypeClass)
    {
        $this->formTypeClass = $formTypeClass;
    }
}
