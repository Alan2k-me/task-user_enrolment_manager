<?php
namespace App;

// Represents a course.
class course {

    // @var int Unique ID of course.
    public int $id;

    // @var string Name of course.
    public string $title;

    /*
    Populate the object.
    @param int $id
    @param string $title
    */
    public function __construct(int $id, string $title) {
        $this->id = $id;
        $this->title = $title;
    }
}
?>