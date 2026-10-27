<?php
require_once "db.php";

class Student {

    private $conn;

    function __construct() {
        $this->conn = get_connection();
    }

    function __destruct() {
        if ($this->conn !== null) {
            $this->conn->close();
        }
    }

    function add_student(
        $name, $gender, $dob, $mobile,
        $email, $address, $department, $cgpa
    ) {
        $sql = "INSERT INTO students
                (name, gender, dob, mobile, email,
                 address, department, cgpa)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

        $ps = $this->conn->prepare($sql);

        $ps->bind_param(
            "sssssssd",
            $name, $gender, $dob, $mobile,
            $email, $address, $department, $cgpa
        );

        $res = $ps->execute();
        $ps->close();

        return $res;
    }

    function all_students() {
        $sql = "SELECT * FROM students ORDER BY student_id";

        $ps = $this->conn->prepare($sql);
        $ps->execute();

        $rs = $ps->get_result();
        $students = $rs->fetch_all(MYSQLI_ASSOC);

        $ps->close();

        return $students;
    }

    function get_student_by_id($id) {
        $sql = "SELECT * FROM students WHERE student_id = ?";

        $ps = $this->conn->prepare($sql);
        $ps->bind_param("i", $id);
        $ps->execute();

        $rs = $ps->get_result();
        $student = $rs->fetch_assoc();

        $ps->close();

        return $student;
    }

    function update_student(
        $id, $name, $gender, $dob, $mobile,
        $email, $address, $department, $cgpa
    ) {
        $sql = "UPDATE students SET
                name = ?, gender = ?, dob = ?, mobile = ?,
                email = ?, address = ?, department = ?, cgpa = ?
                WHERE student_id = ?";

        $ps = $this->conn->prepare($sql);

        $ps->bind_param(
            "sssssssdi",
            $name, $gender, $dob, $mobile,
            $email, $address, $department, $cgpa, $id
        );

        $res = $ps->execute();
        $ps->close();

        return $res;
    }

    function delete_student($id) {
        $sql = "DELETE FROM students WHERE student_id = ?";

        $ps = $this->conn->prepare($sql);
        $ps->bind_param("i", $id);

        $result = $ps->execute();
        $ps->close();

        return $result;
    }
}
?>