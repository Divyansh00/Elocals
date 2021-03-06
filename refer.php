<?php
include('db.php');
session_start();

//assign the value entered by the user to respective variables
$mobile = mysqli_real_escape_string($conn,$_POST["mobile"] ); 
$referral = mysqli_real_escape_string($conn,$_POST["code"]);

//check whether the mobile value is empty , if false, then  continue 
if(!empty($mobile))
{
    //select the user whose mobile nummber is  given
    $sql = "SELECT * FROM users WHERE mobile='$mobile'";
    $res = mysqli_query($conn,$sql);
    $count = mysqli_num_rows($res);

    if($count == 0) //if user des not exist, ask them to signup first
    {
        echo "You need to signup in elocals app first";
    }
    else
    {
        while($row = $res->fetch_assoc())// fetch user details
        {
            $cb = $row["cashbackstatus"]; 
            if($cb == "DONE")//check the cashback status, whether DONE or null
            {
                echo "Cashback is already been given<br/>";
                echo $row["myrefer"];
                $_SESSION['referral_code']=$row["myrefer"]; //store the referral code in session variable, so that it can be used while sharing the referral throught social media
            }
            else
            {
                echo "Cashback earned<br/>";
                echo $row["myrefer"];
                $_SESSION['referral_code']=$row["myrefer"];

                $sql2 = "UPDATE users SET cashbackstatus = 'Done' WHERE mobile = '$mobile'";
                $res2 = mysqli_query($conn,$sql2);

                //get the current timestamp
                $time = "SELECT CURRENT_TIMESTAMP";
                $res_time = mysqli_query($conn,$time);
                while($row2 = $res_time->fetch_assoc())
                {
                    $stamp = $row2['CURRENT_TIMESTAMP'];
                }

                $sql3 = "INSERT INTO passbook VALUES('$mobile','Signup Bonus','Signup cash received',100,'$stamp')";
                $res3 = mysqli_query($conn,$sql3);

                //select the entry for mobile in cashback table
                $sql4 = "SELECT * FROM cashback WHERE mobile='$mobile'";
                $res4 = mysqli_query($conn,$sql4);
                $count4 = mysqli_num_rows($res4);
                
                //if it does not exist, create new entry
                if($count4 == 0)
                {
                    $sql5 = "INSERT INTO cashback VALUES($mobile,100)";
                    $res5 = mysqli_query($conn,$sql5);
                }
                //else add Rs.100 to the existing entry
                else
                {
                    $sql5 = "UPDATE cashback SET amount = amount+100 WHERE mobile = '$mobile'";
                    $res5 = mysqli_query($conn,$sql5);
                }
            }
        }
        if(!empty($referral))
        {
            // Get number of records in refercount table where referralcode = (refercode entered by user)
            $sql6 = "SELECT * FROM refercount WHERE referralcode='$referral'";
            $res6 = mysqli_query($conn,$sql6);
            $count6 = mysqli_num_rows($res6);
            
            //if count>10 do nothing else,
            if($count6 <= 10)
            {
                //get the mobile number whose myrefer = referralcode entered by user
                $sql7 = "SELECT * FROM users WHERE myrefer='$referral'";
                $res7 = mysqli_query($conn,$sql7);
                $mob = '';
                while($row3 = $res7->fetch_assoc())
                {
                    //update the passbook table with title as "Referral bonus" and amount 50 for the mobile of the user who referred.
                    $mob = $row3["mobile"];

                    //get current timestamp
                    $time2 = "SELECT CURRENT_TIMESTAMP";
                    $res_time2 = mysqli_query($conn,$time2);
                    while($row4 = $res_time2->fetch_assoc())
                    {
                        $stamp2 = $row4['CURRENT_TIMESTAMP'];
                    }

                    $sql8 = "INSERT INTO passbook VALUES('$mob','Referral Bonus','eReferral cash received',50,'$stamp2')";
                    $res8 = mysqli_query($conn,$sql8);
                }

                //select the entry for the mobile of the user who referred
                $sql9 = "SELECT * FROM cashback WHERE mobile='$mob'";
                $res9 = mysqli_query($conn,$sql9);
                $count9 = mysqli_num_rows($res9);

                //if it does not exist, create a new entry
                if($count9 == 0)
                {
                    $sql10 = "INSERT INTO cashback VALUES($mob,50)";
                    $res10 = mysqli_query($conn,$sql10);
                }
                //else add Rs.50 in the existing entry
                else
                {
                    $sql10 = "UPDATE cashback SET amount = amount+50 WHERE mobile = '$mob'";
                    $res10 = mysqli_query($conn,$sql10);
                }

                //insert the new record in refercount table
                $sql11 = "INSERT INTO refercount VALUES('$mobile','$referral',50,'$mob','Referral bonus','$stamp2')";
                $res11 = mysqli_query($conn,$sql11);
            }
        }
    }
}
?>