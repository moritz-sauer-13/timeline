<?php

namespace Timeline\DataObjects;

use SilverStripe\Assets\Image;
use SilverStripe\Core\Config\Config;
use SilverStripe\Forms\TextField;
use SilverStripe\ORM\DataObject;
use Timeline\Pages\TimelinePage;

class TimelineItem extends DataObject{

    /*Database*/
    private static $db = [
        'Year' => 'Int',
        'Title' => 'Text',
        'Content' => 'HTMLText'
    ];

    private static $has_one = [
        'Image' => Image::class,
        'TimelinePage' => TimelinePage::class,
    ];

    private static $has_many = [

    ];

    private static $many_many = [

    ];

    private static $many_many_extraFields = [

    ];

    /*CMS*/
    private static $summary_fields = [
        'Year' => 'Jahr',
        'Title' => 'Titel'
    ];

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        $fields->removeByName([
            'TimelinePageID',
        ]);

        $fields->addFieldsToTab('Root.Main', [
            TextField::create('Year', 'Jahr'),
            $titleField = TextField::create('Title', 'Titel')

        ]);

        if(Config::inst()->get('TimelinePageConfig')['TitleWillBePublished']){
            $TitleFieldDescription = 'Der Titel wird mit ausgegeben.';
        } else {
            $TitleFieldDescription = 'Der Titel wird nicht mit ausgegeben und dient lediglich der Orientierung im Backend.';
        }

        $titleField->setDescription($TitleFieldDescription);

        return $fields;
    }

    /*Getter & Setter*/
    //Write here your getters & setters

    /*Helper - Functions*/
    //Write here your helper-functions

    /*Template - Functions*/
}