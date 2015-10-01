<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application;

return array(
    'router' => array
    (
        'routes' => array
        (
            'contact_create' => array 
            (
               'type'    => 'segment',
               'options' => array
               (
                   'route'    => '/person/:id/contact/create',
                   'constraints' => array
                   (
                      'id'         => '[1-9]\d*'
                   )
                   , 'defaults' => array
                   (
                         'controller' => 'Application\Controller\Contact'
                       , 'action'     => 'create'
                   )
               )
            )
            , 'application' => array
            (
                 'type'    => 'segment',
                 'options' => array
                 (
                     'route'    => '/[:controller[/:action[/:id]]]',
                     'constraints' => array
                     (
                           'controller' => '[a-zA-Z][a-zA-Z0-9_-]*'
                         , 'action'     => '[a-z]*'
                         , 'id'         => '[1-9]\d*'
                     )
                     , 'defaults' => array
                     (
                           'controller' => 'Application\Controller\Index'
                         , 'action'     => 'index'
                     )
                 )
            )
        ),
    ),
    'service_manager' => array(
        'abstract_factories' => array(
            'Zend\Cache\Service\StorageCacheAbstractServiceFactory',
            'Zend\Log\LoggerAbstractServiceFactory',
        ),
        'factories' => array(
            'Application\Service\Account'               => 'Application\Service\AccountServiceFactory',
            'Application\Service\Contact'               => 'Application\Service\ContactServiceFactory',
            'Application\Service\Credentials'           => 'Application\Service\CredentialsServiceFactory',
            'Application\Service\EMailAddress'           => 'Application\Service\EMailAddressServiceFactory',
            'Application\Service\Person'                => 'Application\Service\PersonServiceFactory',
            'Application\Service\PhoneNumber'           => 'Application\Service\PhoneNumberServiceFactory',
            'translator'                                => 'Zend\Mvc\Service\TranslatorServiceFactory',
            'Zend\Authentication\AuthenticationService' => function($serviceManager) {return $serviceManager->get('doctrine.authenticationservice.orm_default');}
        ),
    ),
    'translator' => array(
        'locale' => 'en_US',
        'translation_file_patterns' => array(
            array(
                'type'     => 'gettext',
                'base_dir' => __DIR__ . '/../language',
                'pattern'  => '%s.mo',
            ),
        ),
    )
    , 'controllers' => array 
    (
          'factories' => array 
        (
              'Application\Controller\Account'     => 'Application\Controller\AccountControllerFactory'
            , 'Application\Controller\Contact'     => 'Application\Controller\ContactControllerFactory'
            , 'Application\Controller\Credentials' => 'Application\Controller\CredentialsControllerFactory'
            , 'Application\Controller\EMailAddress' => 'Application\Controller\EMailAddressControllerFactory'
            , 'Application\Controller\Person'      => 'Application\Controller\PersonControllerFactory'
            , 'Application\Controller\PhoneNumber' => 'Application\Controller\PhoneNumberControllerFactory'
        )
        , 'aliases' => array 
        (
              'account'     => 'Application\Controller\Account'
            , 'contact'     => 'Application\Controller\Contact'
            , 'credentials' => 'Application\Controller\Credentials'
            , 'emailaddress' => 'Application\Controller\EMailAddress'
            , 'person'      => 'Application\Controller\Person'
            , 'phonenumber' => 'Application\Controller\PhoneNumber'
        )
    )
    , 'view_manager' => array
    (
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => array
        (
            'layout/layout'                    => __DIR__ . '/../view/layout/layout.phtml',
            'application/index/index'          => __DIR__ . '/../view/application/index/index.phtml',
            'application/contact/create'       => __DIR__ . '/../view/application/contact/create.phtml',
            'application/contact/retrieve'     => __DIR__ . '/../view/application/contact/retrieve.phtml',
            'application/contact/update'       => __DIR__ . '/../view/application/contact/update.phtml',
            'application/contact/destroy'      => __DIR__ . '/../view/application/contact/destroy.phtml',
            'application/credentials/create'   => __DIR__ . '/../view/application/credentials/create.phtml',
            'application/credentials/retrieve' => __DIR__ . '/../view/application/credentials/retrieve.phtml',
            'application/credentials/update'   => __DIR__ . '/../view/application/credentials/update.phtml',
            'application/credentials/destroy'  => __DIR__ . '/../view/application/credentials/destroy.phtml',
            'application/emailaddress/create'   => __DIR__ . '/../view/application/emailaddress/create.phtml',
            'application/emailaddress/retrieve' => __DIR__ . '/../view/application/emailaddress/retrieve.phtml',
            'application/emailaddress/update'   => __DIR__ . '/../view/application/emailaddress/update.phtml',
            'application/emailaddress/destroy'  => __DIR__ . '/../view/application/emailaddress/destroy.phtml',
            'application/person/create'        => __DIR__ . '/../view/application/person/create.phtml',
            'application/person/retrieve'      => __DIR__ . '/../view/application/person/retrieve.phtml',
            'application/person/myself'        => __DIR__ . '/../view/application/person/myself.phtml',
            'application/person/update'        => __DIR__ . '/../view/application/person/update.phtml',
            'application/person/destroy'       => __DIR__ . '/../view/application/person/destroy.phtml',
            'application/phonenumber/create'   => __DIR__ . '/../view/application/phonenumber/create.phtml',
            'application/phonenumber/retrieve' => __DIR__ . '/../view/application/phonenumber/retrieve.phtml',
            'application/phonenumber/update'   => __DIR__ . '/../view/application/phonenumber/update.phtml',
            'application/phonenumber/destroy'  => __DIR__ . '/../view/application/phonenumber/destroy.phtml',
            'error/404'                        => __DIR__ . '/../view/error/404.phtml',
            'error/index'                      => __DIR__ . '/../view/error/index.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
    // Placeholder for console routes
    'console' => array
    (
        'router' => array
        (
            'routes' => array()
        )
    )
    , 'doctrine' => array
    (
        'driver' => array
        (
            'application_entities' => array
            (
                  'class' =>'Doctrine\ORM\Mapping\Driver\AnnotationDriver'
                , 'cache' => 'array'
                , 'paths' => array(__DIR__ . '/../src/Application/Entity')
            )

            , 'orm_default' => array
            (
                'drivers' => array
                (
                    'Application\Entity' => 'application_entities'
                )
            )
        )
        , 'authentication' => array
        (
            'orm_default' => array
            (
                  'object_manager'      => 'Doctrine\ORM\EntityManager'
                , 'identity_class'      => 'Application\Entity\Account'
                , 'identity_property'   => 'username'
                , 'credential_property' => 'password'
                , 'credential_callable' => function(\Application\Entity\Account $account, $passwordGiven) {
                    return \Application\Service\AccountService::checkPassword($passwordGiven, $account->getPassword( ));
                }
            )
        )
    )
);
