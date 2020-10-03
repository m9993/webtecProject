<?php
require_once 'db.php';
class IndexModel extends DB
{
    public function check_login($e, $p)
    {
        $q = "SELECT * FROM users WHERE u_email='" . $e . "' and u_password='" . $p . "'";
        $r = mysqli_query($this->con, $q);
        if ($r == false) {
            return 0;
        } else {
            return $r;
        }
    }
    public function getallworkingtimeinfo()
    {
        $q = "Select * from workingtime";
        $r = mysqli_query($this->con, $q);
        return $r;
    }
    public function getallsalaryinfo()
    {
        $q = "Select * from salary";
        $r = mysqli_query($this->con, $q);
        return $r;
    }
    public function getworkingtimeinfo($search)
    {
        $q = "Select * from workingtime where t_id='" . $search . "'";
        $r = mysqli_query($this->con, $q);
        return $r;
    }
    public function update_workingtime($t_id, $u_id, $t_hour)
    {
        $q = "UPDATE `workingtime` SET `u_id` = '" . $u_id . "', `t_hour` = " . $t_hour . " WHERE `workingtime`.`t_id` ='" . $t_id . "'";
        if (mysqli_query($this->con, $q)) {
            return 1;
        } else {
            return 0;
        }
    }
    public function update_salary($s_id, $u_id, $s_amount)
    {
        $q = "UPDATE `salary` SET `u_id` = '" . $u_id . "', `s_amount` = " . $s_amount . " WHERE `salary`.`s_id` ='" . $s_id . "'";
        if (mysqli_query($this->con, $q)) {
            return 1;
        } else {
            return 0;
        }
    }
    public function getallpayemntsinfo()
    {
        $q = "Select * from payment";
        $r = mysqli_query($this->con, $q);
        return $r;
    }
    public function insert_payment($p_id, $u_id, $p_incomeTax, $p_hra, $p_ma, $p_others)
    {
        $q = "INSERT INTO `payment` (`p_id`, `u_id`, `p_incomeTax`, `p_hra`, `p_ma`, `p_others`) VALUES ('" . $p_id . "', '" . $u_id . "', '" . $p_incomeTax . "', '" . $p_hra . "', '" . $p_ma . "', '" . $p_others . "')";
        if (mysqli_query($this->con, $q)) {
            return 1;
        } else {
            return 0;
        }
    }
    public function update_payment($p_id, $u_id, $p_incomeTax, $p_hra, $p_ma, $p_others)
    {
        $q = "UPDATE `payment` SET `u_id` = '" . $u_id . "', `p_incomeTax` = " . $p_incomeTax . ", `p_hra` = " . $p_hra . ", `p_ma` = " . $p_ma . ", `p_others` = " . $p_others . " WHERE `payment`.`p_id` ='" . $p_id . "'";
        if (mysqli_query($this->con, $q)) {
            return 1;
        } else {
            return 0;
        }
    }
    public function delete_payment($p_id)
    {
        $q = "DELETE from payment where `p_id`='" . $p_id . "'";
        if (mysqli_query($this->con, $q)) {
            return 1;
        } else {
            return 0;
        }
    }
    public function insert_workingtime($t_id, $u_id, $t_hour)
    {
        $q = "INSERT INTO `workingtime` (`t_id`, `u_id`, `t_hour`) VALUES ('" . $t_id . "', '" . $u_id . "', '" . $t_hour . "')";
        if (mysqli_query($this->con, $q)) {
            return 1;
        } else {
            return 0;
        }
    }
    public function insert_salary($s_id, $u_id, $s_amount)
    {
        $q = "INSERT INTO `salary` (`s_id`, `u_id`, `s_amount`) VALUES ('" . $s_id . "', '" . $u_id . "', '" . $s_amount . "')";
        if (mysqli_query($this->con, $q)) {
            return 1;
        } else {
            return 0;
        }
    }
    public function delete_workingtime($t_id)
    {
        $q = "DELETE from workingtime where `t_id`='" . $t_id . "'";
        if (mysqli_query($this->con, $q)) {
            return 1;
        } else {
            return 0;
        }
    }

}