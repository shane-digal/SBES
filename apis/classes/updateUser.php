<?php

class UpdateUser{

  public $empData = null;
  public $schedule = null;
  public $deductions = null;
  public $bonuses = null;
  public $empBio = null;

  public $connection = null;

  function __construct(Db $db){
    $this->connection = $db->connectMySqli();
  }

  function executeUpdate($formData) {
    $this->setAllData($formData);
    $this->getEmployeeSchedule();
    $this->getEmployeeBio();
    $this->getEmployeeBonuses();
    $this->getEmployeeDeduction();

    $this->updateEmployeeBio();

    $this->deactivateAllUEmployeeSchedule();
    $this->updateSchedule();
    $this->insertNewSchedules();

    $this->deleteEmployeeBonuses();
    $this->updateEmployeeBonuses();

    $this->deleteEmployeeDeductions();
    $this->insertEmployeeDeductions();

    return '{val: true, message: "Update Success"}' ;
  }

  function updateImageUrl($newImgUrl, $oldImgUrl, $empId) {
    if (isset($newImgUrl) || $newImgUrl != '') {
      $con = $this->connection;
      if (file_exists($oldImgUrl)) {
        unlink($oldImgUrl);
      }
      $sql = "UPDATE rec_employees SET
                employee_imagepath = ?
              WHERE
                employee_id = ?;
      ";

      $rst = $con->prepare($sql);
      $rst->bind_param('si',
        $newImgUrl,
        $empId
      );
      $rst->execute();
      $rst->close();
      return '{val: "Image Updated."}';
    }
    return '{val: "No Update" }';
  }

  // Setting individual variables
  function setAllData($formData){
    $this->empData = $formData;
  }

  function getEmployeeSchedule(){
    $this->schedule = array(
      'days' => $this->empData['schedule_days'],
      'time-from' => $this->empData['time-from'],
      'time-to' => $this->empData['time-to'],
    );
  }

  function getEmployeeBio(){
    $this->empBio = array(
      'firstname' => $this->empData['firstname'],
      'lastname' => $this->empData['lastname'],
      'middlename' => $this->empData['middlename'],
      'position_id' => $this->empData['position'],
      'assignment_id' => $this->empData['assignment'],
      'wage' => $this->empData['wage'],
      'remarks' => $this->empData['remarks'],
      'status' => $this->empData['status'],
      'employee_id' => $this->empData['employee_id'],
      'imgPath' => '',
      'civilStatus' => 'SINGLE'
    );
  }

  function getEmployeeBonuses(){
    $this->bonuses = $this->empData['bonus'];
  }

  function getEmployeeDeduction(){
    $this->deductions = $this->empData['deduction'];
  }
  //End variable setup

  //Start editing execution

  //For User Bio
  function updateEmployeeBio(){
    $con = $this->connection;
    $empBio = $this->empBio;

    $sql = " UPDATE rec_employees
      SET
        project_id = ?,
        position_id = ?,
        employee_fname = ?,
        employee_mname = ?,
        employee_lname = ?,
        employee_empstatus = ?,
        employee_wage = ?,
        employee_status = ?,
        employee_remarks = ?
      WHERE
        employee_id = ?;
    ";

    $rst = $con->prepare($sql);

    $rst->bind_param('iissssdssi',
      $empBio['assignment_id'],
      $empBio['position_id'],
      $empBio['firstname'],
      $empBio['lastname'],
      $empBio['middlename'],
      $empBio['status'],
      $empBio['wage'],
      $empBio['civilStatus'],
      $empBio['remarks'],
      $empBio['employee_id']
    );

    $rst->execute();
    $rst->close();
  }
  //End user bio

  //For employee schedule
  function deactivateAllUEmployeeSchedule(){
    $con = $this->connection;

    $sql = "UPDATE rec_empschedules
      SET
        empschedule_status = 'INACTIVE'
      WHERE
        employee_id = ?
    ";

    $rst = $con->prepare($sql);

    $rst->bind_param('i',
      $this->empBio['employee_id']
    );

    $rst->execute();
    $rst->close();
  }

  function updateSchedule(){
    $con = $this->connection;
    $userSchedule = $this->schedule;

    $sql = "UPDATE rec_empschedules
            SET
              empschedule_in = ?,
              empschedule_out = ?,
              empschedule_status = 'ACTIVE'
            WHERE
                  empschedule_day = ?
              AND employee_id = ?;
        ";
    $rst = $con->prepare($sql);
    foreach($userSchedule['days'] as $key => $val) {
      $rst->bind_param('sssi'
        , $userSchedule['time-from'][$key]
        , $userSchedule['time-to'][$key]
        , $val
        , $this->empBio['employee_id']
      );
      $rst->execute();
    }

    $rst->close();
  }

  function insertNewSchedules(){
    $con = $this->connection;
    $userSchedule = $this->schedule;

    $sql = "INSERT INTO rec_empschedules
	            (employee_id, empschedule_day, empschedule_in, empschedule_out, empschedule_status)
            SELECT * FROM
              (SELECT
                ? as id,
                ? as day,
                ? as timein,
                ? as timeut,
                'ACTIVE') as temp
            WHERE NOT EXISTS
              (SELECT employee_id, empschedule_day
                FROM rec_empschedules
                WHERE employee_id = ?
              );
    ";

    $rst = $con->prepare($sql);
    print_r($con->error);

    foreach ($userSchedule['days'] as $key => $value) {
      $rst->bind_param('isssi'
        , $this->empBio['employee_id']
        , $value
        , $userSchedule['time-from'][$key]
        , $userSchedule['time-to'][$key]
        , $this->empBio['employee_id']
      );
      $rst->execute();
    }
    $rst->close();
  }
  //end employee schedule

  //for bonuses
  function updateEmployeeBonuses(){
    $con = $this->connection;
    $bonuses = $this->bonuses;

    $sql = "INSERT INTO rec_empbonuses
              (employee_id, bonus_id)
            VALUES
              (?, ?);
    ";

    $rst = $con->prepare($sql);
    foreach ($bonuses as $key => $value) {
      $rst->bind_param('ii'
        , $this->empBio['employee_id']
        , $value
      );
      $rst->execute();
    }
    $rst->close();
  }

  function deleteEmployeeBonuses(){
    $con = $this->connection;

    $sql = "DELETE FROM rec_empbonuses
            WHERE employee_id = ?
            ";
    $rst = $con->prepare($sql);
    $rst->bind_param('i', $this->empBio['employee_id']);
    $rst->execute();
    $rst->close();
  }
  //end bonuses

  //for deductions
  function deleteEmployeeDeductions(){
    $con = $this->connection;

    $sql = "DELETE FROM rec_empdeductions
            WHERE employee_id = ?";

    $rst = $con->prepare($sql);
    $rst->bind_param('i', $this->empBio['employee_id']);
    $rst->execute();
    $rst->close();
  }

  function insertEmployeeDeductions(){
    $con = $this->connection;
    $deductions = $this->deductions;

    $sql = "INSERT INTO rec_empdeductions
              (employee_id, deduction_id)
            VALUES
              (?, ?);
           ";
    $rst = $con->prepare($sql);
    foreach ($deductions as $key => $value) {
      $rst->bind_param('ii'
        , $this->empBio['employee_id']
        , $value
      );
      $rst->execute();
    }
    $rst->close();
  }
  //end deductions

  public function updateStatus($empId, $status) {
    $con = $this->connection;

    $sql = "UPDATE rec_employees SET
              employee_empstatus = ?
            WHERE
              employee_id = ?;
          ";

    $rst = $con->prepare($sql);
    $rst->bind_param('si',
      $status,
      $empId
    );
    $rst->execute();
    $rst->close();
    return '{val: "Status Updated."}';
  }

  //Data Checking -- used for testing
  public function checkCurrentData(){
    return $this->empBio;
  }

  function getAllData(){
    return $this->empData;
  }

}
