<?php

/**
 * Craft OAuth by Dukt
 *
 * @package   Craft OAuth
 * @author    Benjamin David
 * @copyright Copyright (c) 2014, Dukt
 * @license   https://dukt.net/craft/oauth/docs/license
 * @link      https://dukt.net/craft/oauth/
 */

namespace Craft;

class LikeModel extends BaseModel
{
    /**
     * Define Attributes
     */
    public function defineAttributes()
    {
        return array(
            'id' => AttributeType::Number,
            'elementId' => AttributeType::Number,
            'userId' => AttributeType::Number,
        );
    }

    public function getUser()
    {
        if ($this->userId) {
            return craft()->users->getUserById($this->userId);
        }
    }

    public function getElement()
    {
        if($this->elementId)
        {
            return craft()->elements->getElementById($this->elementId);
        }
    }
}
