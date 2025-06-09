<?php
namespace App;

// Manage enrolments of users in courses.
class enrolment_manager {
    // @var array List of user objects.
    private array $users = [];

    // @var array List of course objects.
    private array $courses = [];

    // @var array List of enrolments.
    private array $enrolments = [];

    /*
    Populate valid users and courses in the object's memory to use for enrolments.
    @param array $users Array of user objects.
    @param array $courses Array of course objects.
     */
    public function __construct(array $users, array $courses) {
        // We populate this class with user and course data instead of relying on a database to simplify the application.
        $this->users = $users;
        $this->courses = $courses;
    }

    /*
    Enrol a user in a course.
    @param int $userid ID of user object.
    @param int $courseid ID of course object.
    @return void
     */
    public function enrol_user(int $userid, int $courseid): void {
        // Check if the user exists
        if(!isset($this->users[$userid])) {
            throw new \InvalidArgumentException("User ID $userid does not exist.");
        }
        
        // Check if the course exists
        if(!isset($this->courses[$courseid])) {
            throw new \InvalidArgumentException("Course ID $courseid does not exist.");
        }

        // Add course to the user's enrolments
        $this->enrolments[$userid][] = $courseid;
    }

    /*
    Unenrol a user from a course.
    @param int $userid ID of user object.
    @param int $courseid ID of user object.
    @return void
     */
    public function unenrol_user(int $userid, int $courseid): void {
        // Check if the user exists
        if(!isset($this->users[$userid])) {
            throw new \InvalidArgumentException("User ID $userid does not exist.");
        }
        
        // Check if the course exists
        if(!isset($this->courses[$courseid])) {
            throw new \InvalidArgumentException("Course ID $courseid does not exist.");
        }

        // Remove course from the user's enrolments
        $this->enrolments[$userid] = array_diff($this->enrolments[$userid],[$courseid]);
    }

    /*
    Get all courses a user is enrolled in.
    @param int $userid ID of user object.
    @return array
     */
    public function get_user_courses(int $userid): array {
        // Check if the user exists
        if(!isset($this->users[$userid])) {
            throw new \InvalidArgumentException("User ID $userid does not exist.");
        }

        // Checking for user's enrolments
        if(!isset($this->enrolments[$userid])) {
            return []; // User is not enrolled into anything
        }
        
        $enrolled_courses = [];
        foreach($this->enrolments[$userid] as $courseid) {
            if(isset($this->courses[$courseid])) {
                $enrolled_courses[] = $this->courses[$courseid];
            }
        }
        
        return $enrolled_courses;
    }
}
?>