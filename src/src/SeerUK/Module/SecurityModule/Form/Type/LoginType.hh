<?hh

/*
 * This file is part of elliotwright.co
 *
 * (c) Elliot Wright <elliot@elliotwright.co>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SeerUK\Module\SecurityModule\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Article Form Type
 *
 * @author Elliot Wright <elliot@elliotwright.co>
 */
class LoginType extends AbstractType
{
    /**
     * {@inheritDoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('username', 'text')
            ->add('password', 'password');
    }

    /**
     * {@inheritDoc}
     */
    public function getName(): string
    {
        return 'login';
    }
}
