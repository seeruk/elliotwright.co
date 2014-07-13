<?hh

use SeerUK\Module\SecurityModule\Data\Entity\User;
use SeerUK\Module\SecurityModule\Authentication\Authenticator\UserAuthenticator;

return function($container) {
    // Services
    $container->set('sm.authenticator.user', function($c) {
        $em = $c->get('doctrine.orm.entity_manager');

        return new UserAuthenticator($em->getRepository(User::class));
    });
};
