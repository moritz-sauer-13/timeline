<?php

namespace Timeline\Pages;

use Page;
use SilverStripe\Core\Config\Config;
use SilverStripe\Forms\GridField\GridField;
use SilverStripe\Forms\GridField\GridFieldConfig_RecordEditor;
use Symbiote\GridFieldExtensions\GridFieldOrderableRows;
use Timeline\DataObjects\TimelineItem;

class TimelinePage extends Page
{
    /*Database*/
    private static $db = [

    ];

    private static $has_one = [

    ];

    private static $has_many = [
        'TimelineItems' => TimelineItem::class,
    ];

    private static $many_many = [

    ];

    private static $many_many_extraFields = [

    ];

    /*CMS*/
    private static $summary_fields = [

    ];

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        $fields->removeByName([
            'TimelineItems',
        ]);

        $sortOrder = Config::inst()->get("TimelinePageConfig")["SortOrder"];
        $fields->addFieldsToTab('Root.Jahreszahlen', [
            GridField::create(
                'TimelineItems',
                'Jahreszahlen',
                $this->TimelineItems()->sort('Year ' . $sortOrder),
                GridFieldConfig_RecordEditor::create(50)
            )
        ]);

        return $fields;
    }

    public function getSettingsFields()
    {

        $fields = parent::getSettingsFields();

        $fields->removeByName([

        ]);

        $fields->addFieldsToTab('Root.Settings', [

        ]);

        return $fields;
    }

    /*Getter & Setter*/
    //Write here your getters & setters

    /*Helper - Functions*/
    //Write here your helper-functions

    /*Template - Functions*/
    public function sortedTimelineItems(){
        $sortOrder = Config::inst()->get("TimelinePageConfig")["SortOrder"];
        return $this->TimelineItems()->sort('Year ' . $sortOrder);
    }
}
