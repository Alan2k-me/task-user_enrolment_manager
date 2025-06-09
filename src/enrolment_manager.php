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
        foreach($users as $user) {
            $this->users[$user->id] = $user->name;
        }
        foreach($courses as $course) {
            $this->courses[$course->id] = $course->title;
        }
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

        // Initialise enrolments for user if not already set
        if(!isset($this->enrolments[$userid])) {
            $this->enrolments[$userid] = [];
        }
        
        // Check if already enrolled
        if(in_array($courseid, $this->enrolments[$userid])) {
            throw new \LogicException("User $userid is already enrolled in the course $courseid.");
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
        
        // Check if user not enrolled at all or not enrolled into specified course
        if(!isset($this->enrolments[$userid]) || !in_array($courseid, $this->enrolments[$userid])) {
            throw new \LogicException("User $userid is not already enrolled in the course $courseid.");
        }
        
        // Remove course from the user's enrolments
        $this->enrolments[$userid] = array_diff($this->enrolments[$userid],[$courseid]);
        
        // Remove user from the list if no enrolments left
        if(empty($this->enrolments[$userid])) {
            unset($this->enrolments[$userid]);
        }
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