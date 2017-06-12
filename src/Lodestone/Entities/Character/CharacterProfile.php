<?php

namespace Lodestone\Entities\Character;

use Lodestone\{
    Entities\AbstractEntity,
    Validator\CharacterValidator
};

/**
 * Class Profile
 *
 * @package Lodestone\Entities\Character
 */
class CharacterProfile extends AbstractEntity
{
    /**
     * @var string
     */
    public $id;

    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $server;

    /**
     * @var string|null
     */
    public $title = null;

    /**
     * @var string
     */
    public $avatar;

    /**
     * @var string
     */
    public $portrait;

    /**
     * @var string
     */
    public $biography = '';

    /**
     * @var string
     */
    public $race;

    /**
     * @var string
     */
    public $clan;

    /**
     * @var string
     */
    public $gender;

    /**
     * @var string
     */
    public $nameday;

    /**
     * @var Guardian
     */
    public $guardian;

    /**
     * @var City
     */
    public $city;

    /**
     * @var GrandCompany|null
     */
    public $grandcompany = null;

    /**
     * @var string|null
     */
    public $freecompany = null;

    /**
     * @var array
     */
    public $classjobs = [];

    /**
     * @var array
     */
    public $attributes = [];

    /**
     * @var Collectables
     */
    public $collectables = null;

    /**
     * @var array
     */
    public $gear = [];

    /**
     * @var ClassJob
     */
    public $activeClassJob = null;

    /**
     * Profile constructor.
     *
     * @param $id
     */
    public function __construct($id)
    {
        CharacterValidator::getInstance()
            ->check($id, 'ID')
            ->isInitialized()
            ->isNotEmpty()
            ->isNumeric()
            ->validate();

        $this->id = $id;

        // profile classes
        $this->collectables = new Collectables();
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return $this
     */
    public function setName(string $name)
    {
        CharacterValidator::getInstance()
            ->check($name, 'Name')
            ->isInitialized()
            ->isNotEmpty()
            ->isString()
            ->isValidCharacterName()
            ->validate();

        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getServer(): string
    {
        return $this->server;
    }

    /**
     * @param string $server
     * @return $this
     */
    public function setServer(string $server)
    {
        CharacterValidator::getInstance()
            ->check($server, 'Server')
            ->isInitialized()
            ->isNotEmpty()
            ->isString()
            ->validate();

        $this->server = $server;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getTitle() {
        return $this->title;
    }

    /**
     * @param string $title
     * @return $this
     */
    public function setTitle($title)
    {
        CharacterValidator::getInstance()
            ->check($title, 'Title')
            ->isInitialized()
            ->isNotEmpty()
            ->isString()
            ->validate();

        $this->title = $title;

        return $this;
    }

    /**
     * @return string
     */
    public function getAvatar(): string
    {
        return $this->avatar;
    }

    /**
     * @param string $avatar
     * @return $this
     */
    public function setAvatar(string $avatar)
    {
        CharacterValidator::getInstance()
            ->check($avatar, 'Avatar URL')
            ->isInitialized()
            ->isNotEmpty()
            ->isString()
            ->validate();

        $this->avatar = $avatar;

        return $this;
    }

    /**
     * @return string
     */
    public function getPortrait(): string
    {
        return $this->portrait;
    }

    /**
     * @param string $portrait
     * @return $this
     */
    public function setPortrait(string $portrait)
    {
        CharacterValidator::getInstance()
            ->check($portrait, 'Portrait URL')
            ->isInitialized()
            ->isNotEmpty()
            ->isString()
            ->validate();

        $this->portrait = $portrait;

        return $this;
    }

    /**
     * @return string
     */
    public function getBiography(): string
    {
        return $this->biography;
    }

    /**
     * @param string $biography
     * @return $this
     */
    public function setBiography(string $biography)
    {
        CharacterValidator::getInstance()
            ->check($biography, 'Biography')
            ->isInitialized()
            ->isStringOrEmpty()
            ->validate();

        $this->biography = $biography;

        return $this;
    }

    /**
     * @return string
     */
    public function getRace(): string
    {
        return $this->race;
    }

    /**
     * @param string $race
     * @return $this
     */
    public function setRace(string $race)
    {
        CharacterValidator::getInstance()
            ->check($race, 'Race')
            ->isInitialized()
            ->isNotEmpty()
            ->isString()
            ->validate();

        $this->race = $race;

        return $this;
    }

    /**
     * @return string
     */
    public function getClan(): string
    {
        return $this->clan;
    }

    /**
     * @param string $clan
     * @return $this
     */
    public function setClan(string $clan)
    {
        CharacterValidator::getInstance()
            ->check($clan, 'Clan')
            ->isInitialized()
            ->isNotEmpty()
            ->isString()
            ->validate();

        $this->clan = $clan;

        return $this;
    }

    /**
     * @return string
     */
    public function getGender(): string
    {
        return $this->gender;
    }

    /**
     * @param string $gender
     * @return $this
     */
    public function setGender(string $gender)
    {
        CharacterValidator::getInstance()
            ->check($gender, 'Gender')
            ->isInitialized()
            ->isNotEmpty()
            ->isString()
            ->validate();

        $this->gender = $gender;

        return $this;
    }

    /**
     * @return string
     */
    public function getNameday(): string
    {
        return $this->nameday;
    }

    /**
     * @param string $nameday
     * @return $this
     */
    public function setNameday(string $nameday)
    {
        CharacterValidator::getInstance()
            ->check($nameday, 'Nameday')
            ->isInitialized()
            ->isNotEmpty()
            ->isString()
            ->validate();

        $this->nameday = $nameday;

        return $this;
    }

    /**
     * @return Guardian
     */
    public function getGuardian(): Guardian
    {
        return $this->guardian;
    }

    /**
     * @param Guardian $guardian
     * @return $this
     */
    public function setGuardian(Guardian $guardian)
    {
        CharacterValidator::getInstance()
            ->check($guardian, 'Guardian')
            ->isInitialized()
            ->validate();

        $this->guardian = $guardian;

        return $this;
    }

    /**
     * @return City
     */
    public function getCity(): City
    {
        return $this->city;
    }

    /**
     * @param City $city
     * @return $this
     */
    public function setCity(City $city)
    {
        CharacterValidator::getInstance()
            ->check($city, 'City')
            ->isInitialized()
            ->validate();

        $this->city = $city;

        return $this;
    }

    /**
     * @return GrandCompany|null
     */
    public function getGrandcompany()
    {
        return $this->grandcompany;
    }

    /**
     * @param GrandCompany $grandcompany
     * @return $this
     */
    public function setGrandcompany($grandcompany)
    {
        CharacterValidator::getInstance()
            ->check($grandcompany, 'Grand Company')
            ->isInitialized()
            ->validate();

        $this->grandcompany = $grandcompany;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getFreecompany()
    {
        return $this->freecompany;
    }

    /**
     * @param string $freecompany
     * @return $this
     */
    public function setFreecompany($freecompany)
    {
        CharacterValidator::getInstance()
            ->check($freecompany, 'Free Company')
            ->isInitialized()
            ->isNotEmpty()
            ->isString()
            ->validate();

        $this->freecompany = $freecompany;

        return $this;
    }
}