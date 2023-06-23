<?php require_once('header.php');

try{
    $statement= $pdo->prepare("CREATE TABLE message(
        messageID int AUTO_INCREMENT PRIMARY KEY,
        senderID int NOT null,
        receiverID int NOT null,
        messageTime datetime DEFAULT CURRENT_TIMESTAMP
        -- FOREIGN KEY (senderID) REFERENCES customer(customerID),
        -- FOREIGN KEY (senderID) REFERENCES admins(adminID),
        -- FOREIGN KEY (receiverID) REFERENCES customer(customerID),
        -- FOREIGN KEY (receiverID) REFERENCES admins(adminID)
    )");
    $statement->execute();

    $statement= $pdo->prepare("CREATE TABLE MESSAGE_TEXT(
        messageTextID int AUTO_INCREMENT PRIMARY KEY,
        messageID int NOT null,
        subject VARCHAR(255) DEFAULT NULL,
        textContent varchar(255) NOT null,
        timeMessage datetime DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (messageID) REFERENCES message(messageID),
        stats int DEFAULT 0)");
    $statement->execute();


}catch(PDOException $es){
    
}

if (isset($_POST['createSupport'])) {
    $subject = $_POST['subject'];
    $textContent = $_POST['message'];
    $senderID=$customerID;
    $receiverID='1';

    

    
    
    if($receiverID==0) {
        
    }elseif(empty($textContent))
        $error= "Message Box is Required!";
    else{
        $result=$pdo->prepare("INSERT INTO message(senderID, receiverID) VALUES(?, ?)");
        $result->execute(array($senderID,$receiverID));

        $con="where senderID=?";
        $messageID=messageDetails($senderID,'messageID',$con);
        $result1=$pdo->prepare("INSERT INTO message_text(messageID,subject, textContent) VALUES('$messageID','$subject', '$textContent')");
        $result1->execute();
       $success="Tricket Create Successfully";
    }
}
?>



<div class="row justify-content-center mb-4">
    <div class="col-12 col-md-6 col-lg-8">

        <form class="card" method="POST">
            <div class="card-header">
                <h4>Create a Support Ticket</h4>
            </div>
            <!-- ERROR MASSAGE -->
            <?php if(isset($error)): ?>
            <div class="alert alert-danger">
                <?php echo $error;?>
            </div>
            <?php endif; ?>
            <!-- SUCCESS MASSAGE -->
            <?php if(isset($success)): ?>
            <div class="alert alert-success">
                <?php echo $success;?>
            </div>
            <?php endif; ?>
            <div class="card-body">
                <!-- <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" value="<?php echo customerDetails($customerID,'firstName')." ".customerDetails($customerID,'lastName'); ?>" class="form-control" name="name" required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control"  name="email" required>
                </div> -->

                <div class="form-group">
                    <label for="subject">Subject:</label>
                    <input type="text" class="form-control" name="subject" required>
                </div>

                <div class="form-group">
                    <label for="message">Message:</label><br>
                    <textarea name="message" class="form-control" rows="5" cols="30" required></textarea>
                </div>
            </div>
            <div class="card-footer text-right">
                <input class="btn btn-primary mr-1" name="createSupport" type="submit" value="Submit Ticket">
            </div>
        </form>
    </div>
</div>

<?php require_once('footer.php');?>