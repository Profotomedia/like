<?php

namespace Craft;

class Like_OnLikeEntriesNotification extends BaseNotification
{
    /**
     * Event
     */
    public function event()
    {
        return 'like.addLike';
    }

    /**
     * Action : Send a notification when someone likes my entries
     */
    public function action(Event $event)
    {
        if($event->params['like']->getElement()->elementType == 'Entry')
        {
            $data = $this->getDataFromEvent($event);
            $variables = $this->getVariables($data);

            $recipient = $variables['entry']->author;
            $sender = $variables['sender'];
            $relatedElement = $variables['like'];

            // send notification
            craft()->notifications->sendNotification($this->getHandle(), $recipient, $sender, $relatedElement, $data);
        }
    }

    /**
     * Get variables
     */
    public function getVariables($data = array())
    {
        if(!empty($data['likeId']))
        {
            $like = craft()->like->getLikeById($data['likeId']);

            if($like)
            {
                $entry = $like->getElement();
                $sender = $like->getUser();

                return array(
                    'sender' => $sender,
                    'entry' => $entry,
                    'like' => $like,
                );
            }
        }

        return array();
    }

    /**
     * Get data from event
     */
    public function getDataFromEvent(Event $event)
    {
        return array(
            'likeId' => $event->params['like']->id,
            'entryId' => $event->params['like']->likeElementId,
            'senderId' => $event->params['like']->userId
        );
    }

    /**
     * Default Open Url Format
     */
    public function defaultOpenUrlFormat()
    {
        return '{{entry.url}}';
    }

    /**
     * Default Open CP Url Format
     */
    public function defaultOpenCpUrlFormat()
    {
        return '{{entry.cpEditUrl}}';
    }
}