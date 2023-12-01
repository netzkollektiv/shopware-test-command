<?php declare(strict_types=1);

namespace NetzkollektivTestCommand\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

use Shopware\Core\System\SalesChannel\Context\SalesChannelContextService;

class TestCommand extends Command
{
    protected static $defaultName = 'debug:test-command';

    public function __construct(
      private \Shopware\Core\System\SalesChannel\Context\SalesChannelContextRestorer $salesChannelContextRestorer,
      private \Shopware\Core\System\SalesChannel\Context\AbstractSalesChannelContextFactory $salesChannelContextFactory
    ) {
      parent::__construct(); 
    }

    protected function configure(): void
    {
        $this->setDescription('Simple command to test arbitrary functionality.');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {

        // Here goes your code ...

	      $orderId = '6662487b7b894bb39d0bfa1da8af6159';
        $salesChannelId = 'c54daf02da174a258f4842187753867b';
        $languageId = '21a89be7347f4a29916a763d42fdf368';

        $salesChannelContext = $this->salesChannelContextFactory->create(
                '',
                $salesChannelId,
                [ SalesChannelContextService::LANGUAGE_ID => $languageId ]
        );
	      $this->salesChannelContextRestorer->restoreByOrder($orderId, $context);

        // Exit code 0 for success
        return 0;
    }
}
