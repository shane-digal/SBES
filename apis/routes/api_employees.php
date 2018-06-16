<?php
    //READ
    $now = "NOW()";
    switch($q){
        case "GetEmployees":
            $key = (isset($_POST['a']) ? $db->cleanString($_POST['a']) : '');
            $key = '%'.$key.'%';
            $project_id = (isset($_POST['a']) ? $db->cleanString($_POST['a']) : '0');
            $ids = (isset($_POST['a']) ? $_POST['a'] :  '0');
            $position_id = (isset($_POST['']) ? $db->cleanString($_POST['a']) : '1');

            $getEmployees   =
                $con->prepare("	SELECT
                                    re.employee_id,
                                    re.employee_fname,
                                    re.employee_mname,
                                    re.employee_lname,
                                    re.employee_imagepath,
                                    lep.position_name
                                FROM rec_employees AS re
                                INNER JOIN lib_employee_positions AS lep
                                ON re.position_id = lep.position_id
                                WHERE re.project_id = ?
                                AND re.position_id = ?
                                AND (SetFullName(re.employee_id) LIKE ? )
                                AND re.employee_id NOT IN (" . $ids . ")
                                ORDER BY re.employee_lname");
            $getEmployees->bind_param("iis", $project_id, $position_id, $key);
            $message = "";
            $getEmployees->execute();
            $res = $getEmployees->get_result();
            $json_value = $res->fetch_all(MYSQLI_ASSOC);
            $getEmployees->close();
            break;
        case "GetBonuses":
            $sql = "SELECT bonus_id, bonus_name FROM lib_bonuses";
            $message = "Bonuses fetched";
            $rst = $con->prepare($sql);
            $rst->execute();
            $res = $rst->get_result();
            $json_value = $res->fetch_all(MYSQLI_ASSOC);
            $rst->close();
            break;
        case "GetDeductions":
            $sql = "SELECT deduction_id, deduction_name FROM lib_deductions";
            $message = "Deductions fetched";
            $rst = $con->prepare($sql);
            $rst->execute();
            $res = $rst->get_result();
            $json_value = $res->fetch_all(MYSQLI_ASSOC);
            $rst->close();
            break;
        case "GetAllPositions" :
            $sql = "SELECT position_id, position_name FROM lib_employee_positions";
            $message = "Positions fetched";
            $rst = $con->prepare($sql);
            $rst->execute();
            $res = $rst->get_result()   ;
            $json_value = $res->fetch_all(MYSQLI_ASSOC);
            $rst->close();
            break;
        case "GetApprovedProjects" :
            $sql = "SELECT project_id, project_name, project_description
                    FROM rec_projects
                    WHERE project_status NOT IN ('Cancelled', 'Pending', 'Completed')";
            $message = "Projects fetched";
            $rst = $con->prepare($sql);
            $rst->execute();
            $res = $rst->get_result();
            $json_value = $res->fetch_all(MYSQLI_ASSOC);
            $rst->close();
            break;

        case "GetUserBonuses":
            $sql = "SELECT *
                    FROM rec_empbonuses re
                    LEFT JOIN lib_bonuses lb
                        ON re.bonus_id = lb.bonus_id
                    WHERE re.employee_id = ?";
            $rst = $con->prepare($sql);
            $rst->bind_param('i', $_POST['emp_id']);
            $rst->execute();
            $res = $rst->get_result();
            $json_value = $res->fetch_all(MYSQLI_ASSOC);
            $rst->close();
            break;
        case "GetUserDeductions":
            $sql = "SELECT *
                    FROM rec_empdeductions re
                    LEFT JOIN lib_deductions ld
                        ON re.deduction_id = ld.deduction_id
                    WHERE employee_id = ?";
            $rst = $con->prepare($sql);
            $rst->bind_param('i', $_POST['emp_id']);
            $rst->execute();
            $res = $rst->get_result();
            $json_value = $res->fetch_all(MYSQLI_ASSOC);
            $rst->close();
            break;
        case "GetUserSchedule":
            $sql = "SELECT *
                    FROM rec_empschedules
                    WHERE employee_id = ?";
            $rst = $con->prepare($sql);
            $rst->bind_param('i', $_POST['emp_id']);
            $rst->execute();
            $res = $rst->get_result();
            $json_value = $res->fetch_all(MYSQLI_ASSOC);
            $rst->close();
            break;
        case "GetEmployeeFiles":
            $sql = "SELECT *
                    FROM rec_employee_files
                    WHERE employee_id = ?";
            $rst = $con->prepare($sql);
            $rst->bind_param('i', $_POST['emp_id']);
            $rst->execute();
            $res = $rst->get_result();
            $json_value = $res->fetch_all(MYSQLI_ASSOC);
            $rst->close();
            break;
    }

    // CREATE
    switch($q){
        case "InsertNewEmployee":
            $sqlstr = $db->CreateInsertValuesParameters(13);
            $sqlstr = "INSERT INTO rec_employees
                        (
                            project_id,
                            position_id,
                            employee_fname,
                            employee_mname,
                            employee_lname,
                            employee_imagepath,
                            employee_empstatus,
                            employee_wage,
                            employee_tmonth,
                            employee_status,
                            employee_inserted,
                            employee_lastupdated,
                            employee_remarks
                            )
                    VALUES ". $sqlstr .";
            ";
            $sql = $con->prepare($sqlstr);
            $status = 'SINGLE';
            $sql->bind_param("iisssssdsssss"
                            , $_POST['assignment']
                            , $_POST['position']
                            , $_POST['firstname']
                            , $_POST['middlename']
                            , $_POST['lastname']
                            , $_POST['imgUrl']
                            , $_POST['status']
                            , strval($_POST['wage'])
                            , $now
                            , $status
                            , $now
                            , $now
                            , $_POST['remarks']
                        );
            $sql->execute();
            $res = $sql->get_result();
            $json_value = mysqli_insert_id($con);
            $sql->close();
            $message = "Added successfully!";
            break;

        case "InsertSchedule":
            $sqlstr = $db->CreateInsertValuesParameters(5);
            $sqlstr = " INSERT INTO rec_empschedules
            (
               employee_id,
               empschedule_day,
               empschedule_in,
               empschedule_out,
               empschedule_status
            ) VALUES " . $sqlstr .";" ;

            $sql = $con->prepare($sqlstr);
            $status = 'ACTIVE';
            if(isset($_POST['schedule_days'])){
                foreach ($_POST['schedule_days'] as $key => $value) {
                    $sql->bind_param('issss'
                        , $_GET['emp_id']
                        , $value
                        , $_POST['time-from'][$key]
                        , $_POST['time-to'][$key]
                        , $status);
                    $sql->execute();
                }
                $sql->close();
                $message = "Added successfully.";
            }else{
                $message = "Nothing to Add.";
            }
            break;
        case "InsertDeductions" :
            $sqlstr = $db->CreateInsertValuesParameters(2);
            $sqlstr = " INSERT INTO rec_empdeductions
            (
                employee_id,
                deduction_id
            ) VALUES " . $sqlstr .";" ;
            $sql = $con->prepare($sqlstr);

            if(isset($_POST['deduction'])){
                foreach ($_POST['deduction'] as $key => $value) {
                    $sql->bind_param('ii'
                        , $_GET['emp_id']
                        , $value);
                    $sql->execute();
                }
                $sql->close();
                $message = "Added successfully.";
            }else{
                $message = "Nothing to Add.";
            }
            $message = "Added successfully!";
            break;

        case "InsertBonuses" :
            $sqlstr = $db->CreateInsertValuesParameters(2);
            $sqlstr = " INSERT INTO rec_empbonuses
            (
                employee_id,
                bonus_id
            ) VALUES " . $sqlstr .";" ;
            $sql = $con->prepare($sqlstr);


            if(isset($_POST['bonus'])){
                foreach ($_POST['bonus'] as $key => $value) {
                    $sql->bind_param('ii'
                        , $_GET['emp_id']
                        , $value);
                    $sql->execute();
                }
                $sql->close();
                $message = "Added successfully.";
            }else{
                $message = "Nothing to Add.";
            }
            $message = "Added successfully!";
            break;
        case 'addFile':
            $sqlstr = $db->CreateInsertValuesParameters(3);
            $sqlstr = " INSERT INTO rec_employee_files
            (
                employee_id,
                file_name,
                file_link
            ) VALUES " . $sqlstr .";" ;
            $sql = $con->prepare($sqlstr);

            if(isset($_POST['fileData'])){
                foreach ($_POST['fileData'] as $key => $main) {
                    foreach ($main as $k => $value) {
                        $sql->bind_param('iss'
                            , $_POST['emp_id']
                            , $value['filename']
                            , $value['url']);
                        $sql->execute();
                    }
                }
                $sql->close();
                $message = $_POST['emp_id'];
            }
            $message = $_POST['emp_id'];
            break;
    }

//Update
    switch($q){
        case 'UpdateEmployee':
            $json_value = $updateUser->executeUpdate($_POST);
            $message = $updateUser->checkCurrentData();
        case 'UpdateEmployeeImage':
            if (isset($_POST['newImgUrl'])) {
                $json_value = $updateUser->updateImageUrl($_POST['newImgUrl'], $_POST['oldImgUrl'], $_POST['empId']);
                // $json_value = $_POST;
                $message = 'Image URL Updated';
            }
        case 'UpdateEmployeeStatus':
            if(isset($_POST['emp_id'])){
                $json_value = $updateUser->updateStatus($_POST['emp_id'], $_POST['status']);
                $message = '';
            }
        break;
    }

// Delete
    switch($q){
        case 'DeleteUserFile':
            $fileId = $_POST['file_id'];
            $sqlstr = "SELECT * FROM rec_employee_files
                WHERE file_id = $fileId
            ";
            $sql = $con->prepare($sqlstr);
            $sql->execute();
            $res = $sql->get_result();
            foreach($res as $key => $val){
                $file_link = $val['file_link'];
            }
            unlink($file_link);
            $sql->close();
            $sqlstr = "DELETE FROM rec_employee_files
                WHERE file_id = $fileId
            ";
            $sql = $con->prepare($sqlstr);
            $sql->execute();
            $sql->close();

        break;
    }


