<?php
namespace Tests;

use PHPUnit\Framework\TestCase;
use App\user;
use App\course;
use App\enrolment_manager;

//Test the enrolment_manager class.
class enrolment_manager_test extends TestCase {

    // @var enrolment_manager Instance of enrolment_manager.
    private enrolment_manager $manager;

    /*
    Set up the test data and instantiate the manager.
    @return void
    */
    protected function setUp(): void {
        $users = [
            new user(1, "Alice"),
            new user(2, "Bob")
        ];
        $courses = [
            new course(100, "Intro to PHP"),
            new course(200, "Moodle Basics")
        ];
        $this->manager = new enrolment_manager($users, $courses);
    }

    //Test a user can be enrolled.
    public function test_enrol_user_successfully(): void {
        $this->manager->enrol_user(1, 100);
        $courses = $this->manager->get_user_courses(1);
        $this->assertCount(1, $courses);
    }
    
    //Test duplicate enrolment throws error.
    public function test_duplicate_enrolment_throws_exception(): void {
        $this->manager->enrol_user(1, 100);
        $this->expectException(\LogicException::class);
        $this->manager->enrol_user(1,100);
    }

    //Test invalid user ID throws exception.
    public function test_enrol_invalid_user_throws_exception(): void {
        $this->expectException(\InvalidArgumentException::class);
        $this->manager->enrol_user(999, 100);
    }
    
    //Test invalid course ID throws exception.
    public function test_enrol_invalid_course_throws_exception(): void {
        $this->expectException(\InvalidArgumentException::class);
        $this->manager->enrol_user(1, 999);
    }
    
    //Test a user can be unenrolled.
    public function test_unenrol_user_successfully(): void {
        $this->manager->enrol_user(2, 200);
        $this->manager->unenrol_user(2, 200);
        $courses = $this->manager->get_user_courses(2);
        $this->assertEmpty($courses);
    }
    
    //Test unenrolling a user not enrolled throws exception.
    public function test_unenrol_user_not_enrolled_throws_exception(): void {
        $this->expectException(\LogicException::class);
        $this->manager->unenrol_user(1, 200);
    }
    
    //Test unenrolling invalid user ID throws exception.
    public function test_unenrol_invalid_user_throws_exception(): void {
        $this->expectException(\InvalidArgumentException::class);
        $this->manager->unenrol_user(999, 100);
    }

    //Test unenrolling invalid course ID throws exception.
    public function test_unenrol_invalid_course_throws_exception(): void {
        $this->expectException(\InvalidArgumentException::class);
        $this->manager->unenrol_user(1, 999);
    }
    
    //Test getting courses for a user not enrolled returns empty array.
    public function test_get_courses_for_user_with_no_enrolments(): void {
        $courses = $this->manager->get_user_courses(2);
        $this->assertIsArray($courses);
        $this->assertEmpty($courses);
    }
}
?>