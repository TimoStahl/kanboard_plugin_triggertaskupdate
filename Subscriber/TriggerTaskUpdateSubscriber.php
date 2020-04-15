<?php

namespace Kanboard\Plugin\TriggerTaskUpdate\Subscriber;

use Kanboard\Event\GenericEvent;
use Kanboard\Model\CommentModel;
use Kanboard\Model\SubtaskModel;
use Kanboard\Subscriber\BaseSubscriber;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class TriggerTaskUpdateSubscriber extends BaseSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return [
            SubtaskModel::EVENT_CREATE => 'handleEvent',
            SubtaskModel::EVENT_UPDATE => 'handleEvent',
            SubtaskModel::EVENT_DELETE => 'handleEvent',
            CommentModel::EVENT_CREATE => 'handleEvent',
            CommentModel::EVENT_UPDATE => 'handleEvent',
            CommentModel::EVENT_DELETE => 'handleEvent',
        ];
    }

    public function handleEvent(GenericEvent $event, $eventName)
    {
        $task = $event['task'];

        $values = [
            'id' => $task['id'],
            'date_modification' => time(),
        ];

        return $this->taskModificationModel->update($values);
    }
}
