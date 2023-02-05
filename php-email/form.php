<!DOCTYPE html>
<html>
<head>
  <title>E-mail form</title>
  <meta charset="utf-8"/>
  <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, minimum-scale=1.0"/>
  <style>
    * {
      --light-bgcolor: #f0f0f0;
      --div-bgcolor: #dedede; 
      --active-bgcolor: #dfdfdf;
      --accent-color: #2c2c2c;
      --border-color: #2c2c2c;
      font-family: monospace;
      font-size: 98%;
    }
    html, body {
      margin: 0;
      background-color: var(--light-bgcolor);
    }
    div {
      padding: 25px;
      margin: 50px auto 20px;
      width: 300px;
      border: 1px solid var(--border-color);
      border-radius: 10px;
      background-color: var(--div-bgcolor);
    }
    h4 {
      margin: -5px 0 0;
      padding: 0;
    }
    input, textarea {
      border: 1px solid var(--border-color);
      border-radius: 10px;
      padding: 1px 7px 1px;
      background-color: var(--light-bgcolor);
    }
    input.text, textarea.text {
      width: 217px;
      height: 25px;
      margin-bottom: 10px;
      outline: none;
    }
    textarea.text {
      width: calc(100% - 20px);
      padding: 7px;
      height: 200px;
    }
    input.button, button {
      min-width: 80px;
      height: 30px;
      color: var(--accent-color);
    }
    input.button:active {
      background-color: var(--active-bgcolor);
    }
  </style>
</head>
<body>
<?php if (!$RESPONSE) { ?>
  <div id="mail-div">
    <h3 style="color: var(--accent-color);">E-mail form</h3>
    <form method="POST" action="/">

      <label for="from">From:&nbsp;&nbsp;&nbsp;</label>
      <input class="text" id="from" name="from" type="text" placeholder="Enter your name" required/></br>
      <?php if ($from) echo "<h4 style=\"color: tomato;\">$from</h4></br>"; ?>

      <label for="email">E-mail:&nbsp;</label>
      <input class="text" id="email" name="email" type="email" placeholder="Enter your e-mail" required/></br>
      <?php if ($email) echo "<h4 style=\"color: tomato;\">$email</h4></br>"; ?>

      <label for="to">To:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
      <input class="text" id="to" name="to" type="email" placeholder="Enter destination e-mail" required/></br>
      <?php if ($to) echo "<h4 style=\"color: tomato;\">$to</h4></br>"; ?>

      <label for="subject">Subject:</label>
      <input class="text" id="subject" name="subject" type="text" placeholder="Enter subject" required/></br>
      <?php if ($subject) echo "<h4 style=\"color: tomato;\">$subject</h4></br>"; ?>

      <textarea class="text" id="message" name="message" placeholder="Enter e-mail message" required></textarea></br>
      <?php if ($message) echo "<h4 style=\"color: tomato;\">$message</h4></br>"; ?>

      <input class="button" id="submit" type="submit" value="Submit"/>&nbsp;
      <input class="button" id="reset" type="reset" value="Clear"/>
    </form>
  </div>
<?php } else { ?>
  <div id="response-div">
    <h3 style="color: var(--accent-color);">Response</h3>
    <pre><?= $RESPONSE ?></pre>
  </div>
<?php } ?>
</body>
</html>
