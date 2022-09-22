<?php 
session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(!isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] !== true){
    header("location: admin_login.php");
    exit;
}
include 'config.php';
error_reporting(0); 

$id = $_POST['title_id'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./css/style.css"/>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <title>BIT | SIH</title>
</head>
<body>
    <div class="node" id="node"></div>
    <div class="cursor" id="cursor"></div>
    <nav>
        <div class="logo">
            <img src="./assets/logo.png" alt="Logo Image">
            <h3>Bannari Amman Institute of Technology</h3>        
        </div>
        <div class="hamburger">
            <div class="line1"></div>
            <div class="line2"></div>
            <div class="line3"></div>
        </div>
        <ul class="nav-links">
            <li><a class="active nodeHover" href="admin.php">Problem-Statement</a></li>
            <li><a class="nodeHover" href="admin-final-part.php">Final-Participants</a></li>
            <li><a class="nodeHover" href="#footer">Contact Us</a></li>
            <li><a class="btn login-button nodeHover" href="admin_logout.php">Logout</a></li>
        </ul>
    </nav>
    <section class="prob-home" id = "home">
        <h1>REVIEW PARTICIPANT<span>'</span>S</h1>
        <ul class="responsive-table">
            <li class="table-header">
                <div class="col col-1">Team</div>
                <div class="col col-2">Leader Email</div>
                <div class="col col-3">Problem Code</div>
                <div class="col col-4">Abstract Link</div>
                <div class="col col-5">Status</div>

            </li>
        </ul>
        <?php
            $sql = "SELECT * FROM register WHERE problem = $id";
            $result = mysqli_query($link, $sql);
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) { ?>
                    <ul class="responsive-table">
                        <li class="table-row">
                            <div class="col col-1" data-label="Team: "><?php echo $row['name'] ?></div>
                            <div class="col col-2" data-label="Leader Email: "><?php echo $row['email'] ?></div>
                            <div class="col col-3" data-label="Problem Code: "><?php echo $row['problem'] ?></div>
                            <div class="col col-4" data-label="Abstract Link: "><a href="<?php echo $row['link']?>" target="_blank" rel="noreferrer noopener">Click Here! </a></div>
                            <div class="col col-5 accept-reject" data-label="Status: ">
                                <form action="review-final.php" method="POST">
                                    <input type="hidden" name="name" value="<?php echo $row['name'] ?>" />
                                    <input type="hidden" name="roll_no" value="<?php echo $row['roll_no'] ?>" />
                                    <input type="hidden" name="email" value="<?php echo $row['email'] ?>" />
                                    <input type="hidden" name="phonenumber" value="<?php echo $row['phonenumber'] ?>" />
                                    <input type="hidden" name="lab" value="<?php echo $row['lab'] ?>" />
                                    <input type="hidden" name="lab_id" value="<?php echo $row['lab_id'] ?>" />
                                    <input type="hidden" name="problem" value="<?php echo $row['problem'] ?>" />
                                    <input type="hidden" name="link" value="<?php echo $row['link'] ?>" />
                                    <button class="accept" name = "accept"><i class="fa fa-check accept" aria-hidden="true"></i></button>
                                </form>
                                <form action="review-final.php" method="POST"><button class="reject" name = "reject"><i class="fa fa-close reject" aria-hidden="true"></i></button></form>
                            </div>
                        </li>
                    </ul>
              <?php  }
            }
            else{
                ?>
                <center><h3 class="no-record"><?php echo "No records found.";?></h3></center>
           <?php 
            }
        
        ?>

    
    </section>


    <footer>
        <div id="footer" class="footer-content">
            <h3>HACKATHON'22</h3>
            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy.</p>
            <ul class="socials">
                <li></li>
                
            </ul>
            <div class="footer-menu">
                <ul class="f-menu">
                    <li><a class="nodeHover" href="main.php#home">Home</a></li>
                    <li><a class="nodeHover" href="main.php#about">About</a></li>
                    <li><a class="nodeHover" href="main.php#guidelines">Guidelines</a></li>
                    <li><a class="nodeHover" href="">Support</a></li>
                    <li><a class="nodeHover" href="prob-state.php">Problem-Statement</a></li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <p>Created with ❤ by <a class="nodeHover" href="#">Kavinkumar B</a> & <a class="nodeHover" href="#">Monish kumar B</a> </p>

        </div>

    </footer>
</body>
<!-- partial -->
  <script  src="./js/script.js"></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/gsap/2.1.1/TweenMax.min.js'></script>
<script src='https://cdn.jsdelivr.net/gh/hmongouachon/NodeCursor/src/nodecursor-tween.js'></script>


</html>
<script type="text/javascript">
  var initCursor = new NodeCursor({
            cursor : true, 
            node : true, 
            cursor_velocity : 0, 
            node_velocity : 0.75, 
            native_cursor : 'none', 
            element_to_hover : '.nodeHover', 
            cursor_class_hover : 'disable',
            node_class_hover : 'expand', 
            hide_mode : true, 
            hide_timing : 2000, 
        });
</script>