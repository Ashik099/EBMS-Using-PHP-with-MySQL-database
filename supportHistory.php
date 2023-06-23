<?php require_once('header.php');

if (isset($_POST['sendReply'])) {
    $messageBox = $_POST['messageBox'];
    $receiverID=1;
    $senderID=$customerID;
    
    
    if($receiverID==0) {
        
    }elseif(empty($messageBox))
        $error= "Message Box is Required!";
    else{
        $result=$pdo->prepare("INSERT INTO message(senderID, receiverID) VALUES(?, ?)");
        $result->execute(array($senderID,$receiverID));

       
        $con="where receiverID=?";
        $messageID=messageDetails($receiverID,'messageID',$con);
        $result1=$pdo->prepare("INSERT INTO message_text(messageID, textContent) VALUES('$messageID','$messageBox')");
        $result1->execute();
    }
}




?>
<!DOCTYPE html>
<html>

<head>
    <title>Modern Inbox</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <!-- Custom CSS -->
    <style>
    body {
        background-color: #f5f5f5;
    }

    .inbox-container {
        max-width: 800px;
        margin: 0 auto;
        padding: 20px;
    }

    .message {
        border: 1px solid #e0e0e0;
        background-color: #fff;
        padding: 20px;
        margin-bottom: 20px;
        border-radius: 10px;
        box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
        position: relative;
        overflow: hidden;
    }

    .message .title {
        font-weight: bold;
        font-size: 18px;
        margin-bottom: 10px;
    }

    .message .details {
        font-size: 14px;
        color: #888888;
        margin-bottom: 10px;
    }

    .message .content {
        font-size: 16px;
        line-height: 1.6;
        margin-bottom: 20px;
    }

    .message .reply-box {
        display: none;
        border-top: 1px solid #e0e0e0;
        padding-top: 20px;
        margin-top: 20px;
    }

    .message .reply-box textarea {
        width: 100%;
        resize: vertical;
        min-height: 80px;
    }

    .message .reply-box .btn-primary {
        margin-top: 10px;
        float: right;
    }

    .message:hover {
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
    }

    .message:hover .reply-box {
        display: block;
    }

    .message.unread {
        background-color: #f9fafc;
        border-left: 5px solid #007bff;
    }

    .message.unread:hover {
        background-color: #f9fafc;
    }

    .message.unread .title {
        color: #007bff;
    }

    /* .content-box:nth-child(2n) {
            margin-left: 100px;
        } */
    </style>
</head>

<body>
    <div class="inbox-container">

        <div class="message unread">
            <div class="reply-box">
                <form action="#" method="POST">
                    <textarea class="form-control" name="messageBox" placeholder="Type your reply here..."></textarea>
                    <button type="submit" name="sendReply" class="btn btn-primary">Send Reply</button>
                </form>
            </div>
            <?php
                $stm=$pdo->prepare("SELECT 
                        m.messageID, m.senderID, m.receiverID, m.messageTime,
                        mt.messageTextID, mt.subject, mt.textContent, mt.timeMessage
                    FROM 
                        message m
                    JOIN 
                        message_text mt ON m.messageID = mt.messageID
                    WHERE
                        (m.senderID = 1 AND m.receiverID = $customerID)
                        OR (m.senderID = $customerID AND m.receiverID = 1) ORDER BY
                            mt.timeMessage desc limit 3;");
                $stm->execute();
                $result=$stm->fetchAll(PDO::FETCH_ASSOC);
                $srial=1;
                foreach($result as $row):
            ?>
            <div class="content-box">
                <div class="title">Message <?php echo $srial; $srial++;?></div>
                <div class="details">From: <?php if($row['senderID']==1){
                        echo "Admin";
                    }else{
                        echo customerDetails($customerID,'firstName')." ".customerDetails($customerID,'lastName');
                    }?>,
                    <!-- Time Counting -->
                    <?php
                        $database_time = $row['timeMessage'];
                        $current_time = date("Y-m-d H:i:s");

                        $difference = strtotime($current_time) - strtotime($database_time);

                        $hours = floor($difference / 3600);
                        $minutes = floor($difference / 60) - $hours * 60;
                        $seconds = $difference - $hours * 3600 - $minutes * 60;

                        $formatted_hours = str_pad($hours % 12, 2, "0", STR_PAD_LEFT);

                        $formatted_minutes = str_pad($minutes, 2, "0", STR_PAD_LEFT);

                        $formatted_seconds = str_pad($seconds, 2, "0", STR_PAD_LEFT);

                        $time_ago = "";

                        switch ($difference) {
                        case $difference < 60:
                            $time_ago = $formatted_minutes . " minutes ago";
                            break;
                        case $difference < 86400:
                            $time_ago = floor($difference / 3600) . " hours ago";
                            break;
                        default:
                            $time_ago = ceil($difference / 86400) . " days ago";
                            break;
                        }

                        echo $time_ago;
                    ?>
                </div>
                <div class="content">
                    <?php echo $row['textContent'];?>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

    </div>

    <?php require_once('footer.php'); ?>