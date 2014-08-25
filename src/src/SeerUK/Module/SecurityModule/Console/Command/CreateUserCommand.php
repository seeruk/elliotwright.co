<?php

/*
 * This file is part of elliotwright.co
 *
 * (c) Elliot Wright <elliot@elliotwright.co>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SeerUK\Module\SecurityModule\Console\Command;

use SeerUK\Module\SecurityModule\Data\Entity\User;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Create User Command
 *
 * @author Elliot Wright <elliot@elliotwright.co>
 */
class CreateUserCommand extends Command
{
    /**
     * {@inheritDoc}
     */
    protected function configure()
    {
        $this->setName('security:user:create');
        $this->setDescription('Create a new user.');

        $this->addArgument('username', InputArgument::REQUIRED, 'Desired username.');
        $this->addArgument('password', InputArgument::REQUIRED, 'Desired password.');
        $this->addArgument('first_name', InputArgument::REQUIRED, 'Desired first name.');
        $this->addArgument('last_name', InputArgument::REQUIRED, 'Desired last name.');
        $this->addArgument('email', InputArgument::REQUIRED, 'Desired email address.');
    }

    /**
     * {@inheritDoc}
     */
    public function execute(InputInterface $input, OutputInterface $output)
    {
        $container     = $this->getApplication()->getKernel()->getContainer();
        $entityManager = $container->get('doctrine.orm.entity_manager');
        $encoder       = $container->get('sm.encoder.user');

        $username  = $input->getArgument('username');
        $password  = $encoder->encode($input->getArgument('password'));
        $firstName = $input->getArgument('first_name');
        $lastName  = $input->getArgument('last_name');
        $email     = $input->getArgument('email');

        $output->writeln("<info>Creating user <comment>$username</comment>.</info>");

        $user = new User();
        $user->setUsername($username);
        $user->setPassword($password);
        $user->setFirstName($firstName);
        $user->setLastName($lastName);
        $user->setEmail($email);
        $user->setCreated(new \Datetime());

        try {
            $entityManager->persist($user);
            $entityManager->flush();
        } catch (\Exception $e) {
            $output->writeln('<error>An error occurred while adding the new user. Message:</error>');
            $output->writeln("<error>{$e->getMessage()}</error>");
            exit;
        }

        $output->writeln("<info>Successfully create user <comment>$username</comment>.</info>");
    }
}
