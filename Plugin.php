<?php

namespace Kanboard\Plugin\TriggerTaskUpdate;

use Kanboard\Core\Plugin\Base;
use Kanboard\Core\Translator;
use Kanboard\Plugin\TriggerTaskUpdate\Subscriber\TriggerTaskUpdateSubscriber;

class Plugin extends Base
{
    public function initialize()
    {
        $subscriber = new TriggerTaskUpdateSubscriber($this->container);
        $this->dispatcher->addSubscriber($subscriber);
    }
    public function onStartup()
    {
        Translator::load($this->languageModel->getCurrentLanguage(), __DIR__ . '/Locale');
    }
    public function getPluginName()
    {
        return 'TriggerTaskUpdate';
    }
    public function getPluginDescription()
    {
        return t('Trigger task modification date update');
    }
    public function getPluginAuthor()
    {
        return 'BlueTeck';
    }
    public function getPluginVersion()
    {
        return '1.0.0';
    }
    public function getPluginHomepage()
    {
        return 'https://github.com/BlueTeck/kanboard_plugin_triggertaskupdate';
    }
    public function getCompatibleVersion()
    {
        return '>1.2.13';
    }
}
