<?php

/**
 * Order class representsan order from my diner
 * @Jasmine David
 */

class Order
{
    // fields
    private $_food;
    private $_meal;
    private $_condiments;

    function __construct()
    {
        $this->_food = "";
        $this->_meal = "";
        $this->_condiments = "";
    }

    /**
     * getFood return the food item ordered
     * @return string
     */
    public function getFood()
    {
        return $this->_food; // always use the "this" when accessing inside class
    }

    /**
     * setFood set the food item ordered
     * @return string
     */
    public function setFood($food)
    {
        $this->_food = $food;
    }

    /**
     * getMeal
     * @return string
     */
    public function getMeal()
    {
        return $this->_meal;
    }

    /**
     * setMeal
     */
    public function setMeal($meal)
    {
        $this->_meal= $meal;

    }

    /**
     * getCondiments
     * @return string
     */
    public function getCondiments()
    {
        return $this->_condiments;
    }

    /**
     * setCondiments
     * @return string
     */
    public function setCondiments($condiment)
    {
        $this->_condiments = $condiment;
    }

}