<?php
namespace App;

// Represents a user.
class user {

    // @var int Unique ID of user.
    public int $id;

    // @var string Name of user.
    public string $name;

    /*
    Populate the object.
    @param int $id
    @param string $name
    */
    public function __construct(int $id, string $name) {
        $this->id = $id;
        $this->name = $name;
    }
}
?>