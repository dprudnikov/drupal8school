<?php

/**
 * @file
 * Contains \Drupal\admin_toolbar\Command\DefaultCommand.
 */

namespace Drupal\admin_toolbar\Command;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Drupal\Console\Command\Command;
use Drupal\Console\Style\DrupalStyle;

/**
 * Class DefaultCommand.
 *
 * @package Drupal\admin_toolbar
 */
class DefaultCommand extends Command {
  /**
   * {@inheritdoc}
   */
  protected function configure() {
    $this
      ->setName('admin_toolbar:default')
      ->setDescription($this->trans('command.admin_toolbar.default.description'))
      ->addArgument('name', InputArgument::OPTIONAL, $this->trans('command.admin_toolbar.default.arguments.name'))
      ->addOption('yell', NULL, InputOption::VALUE_NONE, $this->trans('command.admin_toolbar.default.options.yell'));
  }

  /**
   * {@inheritdoc}
   */
  protected function execute(InputInterface $input, OutputInterface $output) {

    $io = new DrupalStyle($input, $output);

    $name = $input->getArgument('name');
    if ($name) {
      $text = 'Hello ' . $name;
    }
    else {
      $text = 'Hello';
    }

    $text = sprintf(
      '%s, %s: %s',
      $text,
      'I am a new generated command for the module',
      $this->getModule()
    );

    if ($input->getOption('yell')) {
      $text = strtoupper($text);
    }

    $io->info($text);
  }

}
