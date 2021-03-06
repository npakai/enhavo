<?php
/**
 * Created by PhpStorm.
 * User: philippsester
 * Date: 26.08.19
 * Time: 18:25
 */

namespace Enhavo\Bundle\NewsletterBundle\Command;

use Doctrine\ORM\EntityManager;

use Enhavo\Bundle\NewsletterBundle\Newsletter\NewsletterManager;
use Symfony\Bridge\Monolog\Logger;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;

class SendNewsletterCommand extends Command
{
    use ContainerAwareTrait;

    /**
     * @var NewsletterManager
     */
    private $manager;

    /**
     * @var EntityManager $em
     */
    private $em;

    /**
     * @var Logger $logger
     */
    private $logger;

    /**
     * SendNewsletterCommand constructor.
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em, Logger $logger)
    {
        $this->em = $em;
        $this->logger = $logger;
        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setName('enhavo:newsletter:send')
            ->setDescription('sends a newsletters to its connected receiver');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->manager = $this->container->get('enhavo.newsletter.newsletter_manager');

        $output->writeln('Start sending newsletter to receivers');
        $this->manager->sendToReceivers();
        $output->writeln('Finish sending newsletter to receivers');
    }
}
