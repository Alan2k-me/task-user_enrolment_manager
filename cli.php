<?php
require_once __DIR__ . '/vendor/autoload.php';

use App\user;
use App\course;
use App\enrolment_manager;

$users = [
    new user(1, "Alice"),
    new user(2, "Bob"),
];

$courses = [
    new course(100, "Intro to PHP"),
    new course(200, "Moodle Basics"),
];

$manager = new enrolment_manager($users, $courses);

// Handle CLI arguments
$action = $argv[1] ?? null;
$userid = isset($argv[2]) ? (int)$argv[2] : null;
$courseid = isset($argv[3]) ? (int)$argv[3] : null;

try {
    switch ($action) {
        case 'enrol':
            $manager->enrol_user($userid, $courseid);
            echo "User $userid successfully enrolled in course $courseid.\n";
            break;

        case 'unenrol':
            $manager->unenrol_user($userid, $courseid);
            echo "User $userid successfully unenrolled from course $courseid.\n";
            break;

        case 'list':
            $courses = $manager->get_user_courses($userid);
            echo "User $userid is enrolled in: \n";
            foreach ($courses as $course) {
                echo "- {$course->title} (ID: {$course->id})\n";
            }
            break;

        default:
            echo "Usage:\n";
            echo "  php cli.php enrol <userid> <courseid>\n";
            echo "  php cli.php unenrol <userid> <courseid>\n";
            echo "  php cli.php list <userid>\n";
            echo "Users:\n";
            foreach ($users as $user) {
                echo "- {$user->name} (ID: {$user->id})\n";
            }
            echo "Courses:\n";
            foreach ($courses as $course) {
                echo "- {$course->title} (ID: {$course->id})\n";
            }
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
?>