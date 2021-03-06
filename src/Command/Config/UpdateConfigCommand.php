<?php
namespace App\Command\Config;

use App\Service\Admin\ConfigHandlerService;
use App\Entity\ConfigEntity;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class UpdateConfigCommand extends Command
{
    // the name of the command (the part after "bin/console")
    protected static $defaultName = 'app:config:update';

    private $config_handler_service;

    public function __construct(ConfigHandlerService $config_handler_service)
    {
        parent::__construct();

        $this->config_handler_service = $config_handler_service;
    }

    protected function configure()
    {
        $this
            ->setDescription('Update a config entry');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);

        $name = $io->ask('Entrer le nom (clé)');
        $value = $io->ask('Entrer la nouvelle valeur (facultatif)', null);
        $full_name = $io->ask('Entrer le nom complet (facultatif)', null);
        $desc = $io->ask('Entrer une description (facultatif)', null);
        $type_name = $io->ask('Entrer le type de valeur (bool | int | string). string par défaut', "string");
        $type = ConfigEntity::stringToType($type_name);

        $this->config_handler_service->update($name, $value, $full_name, $desc, $type);

        $io->write('Le configuration a bien été modifié');
    }
}
