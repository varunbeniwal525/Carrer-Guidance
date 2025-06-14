<?php
session_start();
error_reporting(0);
include('connection.php');

if (@$_GET['q'] == 'quiz' && @$_GET['step'] == 2 && isset($_SESSION['6e447159425d2d']) && $_SESSION['6e447159425d2d'] == "6e447159425d2d" && isset($_POST['ans']) && (!isset($_GET['delanswer']))) {
    $eid   = @$_GET['eid'];
    $sn    = @$_GET['n'];
    $total = @$_GET['t'];
    $ans   = $_POST['ans'];
    $qid   = @$_GET['qid'];
    $q = mysqli_query($conn, "SELECT * FROM history WHERE username='".$_SESSION['username']."' AND eid='$_GET[eid]' ") or die('Error197');
    if (mysqli_num_rows($q) > 0) {
        $q = mysqli_query($conn, "SELECT * FROM history WHERE username='".$_SESSION['username']."' AND eid='$_GET[eid]' ") or die('Error197');
        while ($row = mysqli_fetch_array($q)) {
            $time   = $row['timestamp'];
            $status = $row['status'];
        }
        
        $q = mysqli_query($conn, "SELECT * FROM test_quiz WHERE eid='$_GET[eid]' ") or die('Error197');
        while ($row = mysqli_fetch_array($q)) {
            $ttime   = $row['ctime'];
            $qstatus = $row['status'];
        }
        
        $remaining = (($ttime * 60) - ((time() - $time)));
        if ($status == "ongoing" && $remaining > 0 && $qstatus == "enabled") {
            $q = mysqli_query($conn, "SELECT * FROM user_answer WHERE eid='$_GET[eid]' AND username='".$_SESSION['username']."' AND qid='$qid' ") or die('Error115');
            while ($row = mysqli_fetch_array($q)) {
                $prevans = $row['ans'];
            }
            $q = mysqli_query($conn, "SELECT * FROM answer WHERE qid='$qid' ");
            while ($row = mysqli_fetch_array($q)) {
                $ansid = $row['ansid'];
            }
            $q = mysqli_query($conn, "SELECT * FROM user_answer WHERE username='".$_SESSION['username']."' AND eid='$_GET[eid]' AND qid='$qid' ") or die('Error1977');
            if (mysqli_num_rows($q) != 0) {
                $q = mysqli_query($conn, "UPDATE user_answer SET ans='$ans' WHERE username='".$_SESSION['username']."' AND eid='$_GET[eid]' AND qid='$qid' ") or die('Error197');
            } else {
                $q = mysqli_query($conn, "INSERT INTO user_answer VALUES(NULL,'$qid','$ans','$ansid','$_GET[eid]','".$_SESSION['username']."')");
            }
            
            $q = mysqli_query($conn, "SELECT * FROM options WHERE qid='$qid' AND optionid='$ans'");
            while ($row = mysqli_fetch_array($q)) {
                $option = $row['option'];
            }
            
            
            if ($ans == $ansid) {
                $q = mysqli_query($conn, "SELECT * FROM test_quiz WHERE eid='$eid' ");
                while ($row = mysqli_fetch_array($q)) {
                    $correct = $row['correct'];
                    $wrong   = $row['wrong'];
                }
                
                $q = mysqli_query($conn, "SELECT * FROM history WHERE eid='$eid' AND username='".$_SESSION['username']."' ") or die('Error115');
                while ($row = mysqli_fetch_array($q)) {
                    $s = $row['score'];
                    $r = $row['correct'];
                    $w = $row['wrong'];
                }
                
                if (isset($prevans) && $prevans == $ansid) {
                } else if (isset($prevans) && $prevans != $ansid) {
                    $r++;
                    $w--;
                    $s = $s + $correct + $wrong;
                    $q = mysqli_query($conn, "UPDATE `history` SET `score`=$s,`level`=$sn,`correct`=$r,`wrong`=$w, date= NOW()  WHERE  username = '".$_SESSION['username']."' AND eid = '$eid'") or die('Error13');
                } else {
                    $r++;
                    $s = $s + $correct;
                    $q = mysqli_query($conn, "UPDATE `history` SET `score`=$s,`level`=$sn,`correct`=$r, date= NOW()  WHERE  username = '".$_SESSION['username']."' AND eid = '$eid'") or die('Error14');
                }
            } else {
                $q = mysqli_query($conn, "SELECT * FROM test_quiz WHERE eid='$eid' ") or die('Error129');
                while ($row = mysqli_fetch_array($q)) {
                    $wrong   = $row['wrong'];
                    $correct = $row['correct'];
                }
                
                $q = mysqli_query($conn, "SELECT * FROM history WHERE eid='$eid' AND username='".$_SESSION['username']."' ") or die('Error139');
                while ($row = mysqli_fetch_array($q)) {
                    $s = $row['score'];
                    $w = $row['wrong'];
                    $r = $row['correct'];
                }
                if (isset($prevans) && $prevans != $ansid) {
                } else if (isset($prevans) && $prevans == $ansid) {
                    $r--;
                    $w++;
                    $s = $s - $correct - $wrong;
                    $q = mysqli_query($conn, "UPDATE `history` SET `score`=$s,`level`=$sn,`wrong`=$w,`correct`=$r, date= NOW()  WHERE  username = '".$_SESSION['username']."' AND eid = '$eid'") or die('Error11');
                } else {
                    $w++;
                    $s = $s - $wrong;
                    $q = mysqli_query($conn, "UPDATE `history` SET `score`=$s,`level`=$sn,`wrong`=$w,date= NOW()  WHERE  username = '".$_SESSION['username']."' AND eid = '$eid'") or die('Error12');
                }
            }
            header("location:test.php?q=quiz&step=2&eid=$eid&n=$sn&t=$total") or die('Error152');
            
        } else {
            unset($_SESSION['6e447159425d2d']);
            $q = mysqli_query($conn, "UPDATE history SET status='finished' WHERE username='".$_SESSION['username']."' AND eid='$_GET[eid]' ") or die('Error197');
        $q = mysqli_query($conn, "SELECT * FROM history WHERE eid='$_GET[eid]' AND username='".$_SESSION['username']."'") or die('Error156');
                while ($row = mysqli_fetch_array($q)) {
                    $s = $row['score'];
                    $scorestatus = $row['score_updated'];
                }
                if($scorestatus=="false"){
                    $q = mysqli_query($conn, "UPDATE history SET score_updated='true' WHERE username='".$_SESSION['username']."' AND eid='$_GET[eid]' ") or die('Error197');
                    $q = mysqli_query($conn, "SELECT * FROM rank WHERE username='".$_SESSION['username']."'") or die('Error161');
                    $rowcount = mysqli_num_rows($q);
                    if ($rowcount == 0) {
                        $q2 = mysqli_query($conn, "INSERT INTO rank VALUES(NULL,'".$_SESSION['username']."','$s',NOW())") or die('Error165');
                    } else {
                        while ($row = mysqli_fetch_array($q)) {
                            $sun = $row['score'];
                        }
                        
                        $sun = $s + $sun;
                        $q = mysqli_query($conn, "UPDATE `rank` SET `score`=$sun ,time=NOW() WHERE username= '".$_SESSION['username']."'") or die('Error174');
                    }
                }
            header('location:test.php?q=result&eid=' . $_GET[eid]);
        }
    } else {
        unset($_SESSION['6e447159425d2d']);
        $q = mysqli_query($conn, "UPDATE history SET status='finished' WHERE username='".$_SESSION['username']."' AND eid='$_GET[eid]' ") or die('Error197');
        $q = mysqli_query($conn, "SELECT * FROM history WHERE eid='$_GET[eid]' AND username='".$_SESSION['username']."'") or die('Error156');
                while ($row = mysqli_fetch_array($q)) {
                    $s = $row['score'];
                    $scorestatus = $row['score_updated'];
                }
                if($scorestatus=="false"){
                    $q = mysqli_query($conn, "UPDATE history SET score_updated='true' WHERE username='".$_SESSION['username']."' AND eid='$_GET[eid]' ") or die('Error197');
                    $q = mysqli_query($conn, "SELECT * FROM rank WHERE username='".$_SESSION['username']."'") or die('Error161');
                    $rowcount = mysqli_num_rows($q);
                    if ($rowcount == 0) {
                        $q2 = mysqli_query($conn, "INSERT INTO rank VALUES(NULL,'".$_SESSION['username']."','$s',NOW())") or die('Error165');
                    } else {
                        while ($row = mysqli_fetch_array($q)) {
                            $sun = $row['score'];
                        }
                        
                        $sun = $s + $sun;
                        $q = mysqli_query($conn, "UPDATE `rank` SET `score`=$sun ,time=NOW() WHERE username= '".$_SESSION['username']."'") or die('Error174');
                    }
                }
            header('location:test.php?q=result&eid=' . $_GET[eid]);
    }
}

if (@$_GET['q'] == 'quiz' && @$_GET['step'] == 2 && isset($_SESSION['6e447159425d2d']) && $_SESSION['6e447159425d2d'] == "6e447159425d2d" && (!isset($_POST['ans'])) && (isset($_GET['delanswer'])) && $_GET['delanswer'] == "delanswer") {
    $eid   = @$_GET['eid'];
    $sn    = @$_GET['n'];
    $total = @$_GET['t'];
    $qid   = @$_GET['qid'];
    $q = mysqli_query($conn, "SELECT * FROM history WHERE username='".$_SESSION['username']."' AND eid='$_GET[eid]' ") or die('Error197');
    if (mysqli_num_rows($q) > 0) {
        $q = mysqli_query($conn, "SELECT * FROM history WHERE username='".$_SESSION['username']."' AND eid='$_GET[eid]' ") or die('Error197');
        while ($row = mysqli_fetch_array($q)) {
            $time   = $row['timestamp'];
            $status = $row['status'];
        }
        
        $q = mysqli_query($conn, "SELECT * FROM test_quiz WHERE eid='$_GET[eid]' ") or die('Error197');
        while ($row = mysqli_fetch_array($q)) {
            $ttime   = $row['ctime'];
            $qstatus = $row['status'];
        }
        
        $remaining = (($ttime * 60) - ((time() - $time)));
        if ($status == "ongoing" && $remaining > 0 && $qstatus == "enabled") {
            $q = mysqli_query($conn, "SELECT * FROM answer WHERE qid='$qid' ");
            while ($row = mysqli_fetch_array($q)) {
                $ansid = $row['ansid'];
            }
            $q = mysqli_query($conn, "SELECT * FROM user_answer WHERE eid='$_GET[eid]' AND username='".$_SESSION['username']."' AND qid='$qid' ") or die('Error115');
            $row = mysqli_fetch_array($q);
            $ans = $row['ans'];
            $q = mysqli_query($conn, "DELETE FROM user_answer WHERE qid='$qid' AND username='".$_SESSION['username']."' AND eid='$_GET[eid]' ") or die("Error2222");
            if ($ans == $ansid) {
                $q = mysqli_query($conn, "SELECT * FROM test_quiz WHERE eid='$eid' ") or die('Error129');
                while ($row = mysqli_fetch_array($q)) {
                    $wrong   = $row['wrong'];
                    $correct = $row['correct'];
                }
                
                $q = mysqli_query($conn, "SELECT * FROM history WHERE eid='$eid' AND username='".$_SESSION['username']."' ") or die('Error139');
                while ($row = mysqli_fetch_array($q)) {
                    $s = $row['score'];
                    $w = $row['wrong'];
                    $r = $row['correct'];
                }
                $r--;
                $s = $s - $correct;
                $q = mysqli_query($conn, "UPDATE `history` SET `score`=$s,`level`=$sn,`correct`=$r, date= NOW()  WHERE  username = '".$_SESSION['username']."' AND eid = '$eid'") or die('Error11');
            } else {
                $q = mysqli_query($conn, "SELECT * FROM test_quiz WHERE eid='$eid' ") or die('Error129');
                while ($row = mysqli_fetch_array($q)) {
                    $wrong   = $row['wrong'];
                    $correct = $row['correct'];
                }
                
                $q = mysqli_query($conn, "SELECT * FROM history WHERE eid='$eid' AND username='".$_SESSION['username']."' ") or die('Error139');
                while ($row = mysqli_fetch_array($q)) {
                    $s = $row['score'];
                    $w = $row['wrong'];
                    $r = $row['correct'];
                }
                $w--;
                $s = $s + $wrong;
                $q = mysqli_query($conn, "UPDATE `history` SET `score`=$s,`level`=$sn,`wrong`=$w, date= NOW()  WHERE  username = '".$_SESSION['username']."' AND eid = '$eid'") or die('Error11');
            }
            header('location:test.php?q=quiz&step=2&eid=' . $_GET[eid] . '&n=' . $_GET[n] . '&t=' . $total);
            
        } else {
            unset($_SESSION['6e447159425d2d']);
            $q = mysqli_query($conn, "UPDATE history SET status='finished' WHERE username='".$_SESSION['username']."' AND eid='$_GET[eid]' ") or die('Error197');
        $q = mysqli_query($conn, "SELECT * FROM history WHERE eid='$_GET[eid]' AND username='".$_SESSION['username']."'") or die('Error156');
                while ($row = mysqli_fetch_array($q)) {
                    $s = $row['score'];
                    $scorestatus = $row['score_updated'];
                }
                if($scorestatus=="false"){
                    $q = mysqli_query($conn, "UPDATE history SET score_updated='true' WHERE username='".$_SESSION['username']."' AND eid='$_GET[eid]' ") or die('Error197');
                    $q = mysqli_query($conn, "SELECT * FROM rank WHERE username='".$_SESSION['username']."'") or die('Error161');
                    $rowcount = mysqli_num_rows($q);
                    if ($rowcount == 0) {
                        $q2 = mysqli_query($conn, "INSERT INTO rank VALUES(NULL,'".$_SESSION['username']."','$s',NOW())") or die('Error165');
                    } else {
                        while ($row = mysqli_fetch_array($q)) {
                            $sun = $row['score'];
                        }
                        
                        $sun = $s + $sun;
                        $q = mysqli_query($conn, "UPDATE `rank` SET `score`=$sun ,time=NOW() WHERE username= '".$_SESSION['username']."'") or die('Error174');
                    }
                }
            header('location:test.php?q=result&eid=' . $_GET[eid]);
        }
    } else {
        unset($_SESSION['6e447159425d2d']);
        $q = mysqli_query($conn, "UPDATE history SET status='finished' WHERE username='".$_SESSION['username']."' AND eid='$_GET[eid]' ") or die('Error197');
        $q = mysqli_query($conn, "SELECT * FROM history WHERE eid='$_GET[eid]' AND username='".$_SESSION['username']."'") or die('Error156');
                while ($row = mysqli_fetch_array($q)) {
                    $s = $row['score'];
                    $scorestatus = $row['score_updated'];
                }
                if($scorestatus=="false"){
                    $q = mysqli_query($conn, "UPDATE history SET score_updated='true' WHERE username='".$_SESSION['username']."' AND eid='$_GET[eid]' ") or die('Error197');
                    $q = mysqli_query($conn, "SELECT * FROM rank WHERE username='".$_SESSION['username']."'") or die('Error161');
                    $rowcount = mysqli_num_rows($q);
                    if ($rowcount == 0) {
                        $q2 = mysqli_query($conn, "INSERT INTO rank VALUES(NULL,'".$_SESSION['username']."','$s',NOW())") or die('Error165');
                    } else {
                        while ($row = mysqli_fetch_array($q)) {
                            $sun = $row['score'];
                        }
                        
                        $sun = $s + $sun;
                        $q = mysqli_query($conn, "UPDATE `rank` SET `score`=$sun ,time=NOW() WHERE username= '".$_SESSION['username']."'") or die('Error174');
                    }
                }
            header('location:test.php?q=result&eid=' . $_GET[eid]);
    }
}
?>