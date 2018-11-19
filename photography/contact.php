<?php require('includes/config.php');
// array to store page information i.e which menu or page name
$pageArray = array(
"name"  => "Contact",
"menu"  => "usermenu.php",
"style" => "style/",
"sidebar" => "sidebar.php",
"mainImage" =>"images/exampleHeader.jpg",
"headerMount" => "stickyTape.png"
); ?>

<?php include('includes/header.php');?>
<script>
$( "li:contains('Contact')" ).addClass("active");
</script>
		<div class="hasflex" id='main'>
            
            <form class="hasflex contact" method="post" action="contact.php">
                <?php
                $nameErr = $emailErr = $subjectErr = $messageErr = $humanErr = "";
                $name = $email = $subject = $message = $human = "";
                $flag = True;
                $headers = 'From:' . $email . "\r\n" . 'Reply-To:'. $email . "\r\n" . 'X-Mailer: PHP/' . phpversion();
                $to = 'usersemail';
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
            
            <?php if ($nameErr != ""){echo "<span class='error'>". $nameErr."</span>";}?>
            <label>Name</label>
            <input class="input" type="text" name="name" placeholder="Please type your name here">
            <?php if ($emailErr != ""){echo "<span class='error'>". $emailErr."</span>";}?>
            <label>Email</label>
            <input class="input" type="text" name="email" placeholder="Your email address here">
            <?php if ($subjectErr != ""){echo "<span class='error'>". $subjectErr."</span>";}?>
            <label>Subject</label>
            <input class="input" type="text" name="subject" placeholder="The subject of your message here">
            <?php if ($messageErr != ""){echo "<span class='error'>". $messageErr."</span>";}?>
            <label>Message</label>
            <textarea name="message" placeholder="And your message here."></textarea>
            <?php if ($humanErr != ""){echo "<span class='error'>". $humanErr."</span>";}?>
            <label>*What is <?php echo $spam1, "+", $spam2;?> (Anti-spam)</label>
            <input name="human" placeholder=" And to prove you are not a robot, What is <?php echo $spam1, "+", $spam2;?>?">
            <input type = "hidden" name="hide_ans" value="<?php echo $spam_ans ?>">
            <input id="submit" class="submit" type="submit" name="submit" value="Submit">
            </form>
            </div>
            
<?php include('includes/footer.php');?>