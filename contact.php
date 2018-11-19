<?php
   require('includes/config.php');
   $pageArray = array(
"name"  => "HuntByte - Contact",
"style" => "style/",
"images" => "images/",
"boot" => "bootstrap/css/");

include('includes/header.php');
include('includes/menu.php');
include('includes/leftbar.php');?>
<script>
$( "li:contains('Contact')" ).addClass("active");
</script>

        <div class="right">
            <div id="form">
            <h2><span>Contact</span></h2>
            
            <form method="post" action="contact.php">
                <?php
                $nameErr = $emailErr = $subjectErr = $messageErr = $humanErr = "";
                $name = $email = $subject = $message = $human = "";
                $flag = True;
                $headers = 'From:' . $email . "\r\n" . 'Reply-To:'. $email . "\r\n" . 'X-Mailer: PHP/' . phpversion();
                $to = 'chrisjhunter@huntbyte.com';
                $spam1 = rand(0, 10);
                $spam2 = rand(0,10);
                $spam_ans = $spam1 + $spam2;
                $hide_ans = $_POST['hide_ans'];
                $body = "From: $name\n E-Mail: $email\n Message:\n $message";
                
                function test_input($data) {
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
                }
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if (empty($_POST["name"])) {
                    $nameErr = "Name is required";
                    $flag = False;
                  } else {
                    $name = test_input($_POST["name"]);
                    // check if name only contains letters and whitespace
                    if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
                      $nameErr = "Only letters and white space allowed";
                      $flag = False;
                    }
                }

                if (empty($_POST["email"])) {
                  $emailErr = "Email is required";
                  $flag = False;
                } else {
                  $email = test_input($_POST["email"]);
                  // check if e-mail address is well-formed
                  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $emailErr = "Invalid email format";
                    $flag = False;
                  }
                }
                if (empty($_POST["subject"])) {
                    $subjectErr= "Subject is required";
                    $flag = False;
                } else {
                    $subject = test_input($_POST["subject"]);
                }
                if (empty($_POST["message"])) {
                    $messageErr= "Please write something";
                    $flag = False;
                } else {
                    $message = test_input($_POST["message"]);
                }
                if (empty($_POST["human"])) {
                    $humanErr= "Please answer the anti-spam question";
                    $flag = False;
                } else {
                    $human = test_input($_POST["human"]);
                }

                
                if ($_POST['submit'] && $human == $hide_ans && $flag) {
                    if (mail ($to, $subject, $body, $headers)) {
                        echo '<script> 
                            alert("Your message has been sent!");
                            </script>';
                    } else { 
                        echo '<script> 
                            alert("Something went wrong, go back and try again!");
                        </script>'; 
                    }
                } else if ($_POST['submit'] && $human != $hide_ans) {
                    if (empty($_POST["human"])){
                        $humanErr= "Please answer the anti-spam question";
                    } else {
                    $humanErr= "You answered the anti-spam incorrectly";
                    }
                }
            }
            ?>
            <label>Name</label></br>
            <span class="error"><?php echo $nameErr;?></span></br>
            <input class="input" type="text" name="name" value="">
            </br>
            </br>
            <label>Email</label></br>
            <span class="error"><?php echo $emailErr;?></span></br>
            <input class="input" type="text" name="email" value="">
            </br>
            </br>
            <label>Subject</label></br>
            <span class="error"><?php echo $subjectErr;?></span></br>
            <input class="input" type="text" name="subject" value="">
            </br>
            </br>
            <label>Message</label></br>
            <span class="error"><?php echo $messageErr;?></span></br>
            <textarea name="message" val=""></textarea>
            </br>
            </br>
            <label>*What is <?php echo $spam1, "+", $spam2;?> (Anti-spam)</label>
            </br>
            </br>
            <span class="error"><?php echo $humanErr;?></span></br>
            <input name="human" placeholder="Type Here">
            <input type = "hidden" name="hide_ans" value="<?php echo $spam_ans ?>">
            </br>
            </br>
            <input id="submit" class="submit" type="submit" name="submit" value="Submit">
            </form>
            </div>
            <div id="cv">
                <a href="/files/Chris_Hunter_CV.pdf" download="Chris_Hunter_CV.pdf" onclick="myFunction()">Here is a download link for my CV</br></a>
                </br>
                <p id="cons" style = "display:none">Thanks for your consideration.</p>
            </div>
        </div>
<?php include('includes/footer.php'); ?>