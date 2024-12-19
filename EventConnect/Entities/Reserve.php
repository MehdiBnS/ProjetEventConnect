<?php

class Reserve {

    private $id_reserve;
    private $id_user;
    private $id_event;
    private $places;


    /**
     * Get the value of id_reserve
     */ 
    public function getId_reserve()
    {
        return $this->id_reserve;
    }

    /**
     * Set the value of id_reserve
     *
     * @return  self
     */ 
    public function setId_reserve($id_reserve)
    {
        $this->id_reserve = $id_reserve;

        return $this;
    }

    /**
     * Get the value of id_user
     */ 
    public function getId_user()
    {
        return $this->id_user;
    }

    /**
     * Set the value of id_user
     *
     * @return  self
     */ 
    public function setId_user($id_user)
    {
        $this->id_user = $id_user;

        return $this;
    }

    /**
     * Get the value of id_event
     */ 
    public function getId_event()
    {
        return $this->id_event;
    }

    /**
     * Set the value of id_event
     *
     * @return  self
     */ 
    public function setId_event($id_event)
    {
        $this->id_event = $id_event;

        return $this;
    }

    /**
     * Get the value of places
     */ 
    public function getPlaces()
    {
        return $this->places;
    }

    /**
     * Set the value of places
     *
     * @return  self
     */ 
    public function setPlaces($places)
    {
        $this->places = $places;

        return $this;
    }
}