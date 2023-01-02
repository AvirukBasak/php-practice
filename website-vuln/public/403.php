<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no"/>
  <title>Forbidden - Vuln</title>
  <style>
    * {
      --light-bgcolor: #f5ffec;
      --div-bgcolor: #e0ecd3; 
      --active-bgcolor: #eaf3e9;
      --accent-color: #478d00;
      --border-color: #c5d6c7;
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
      width: 290px;
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
    <h3>403</h3>
    <pre>Forbidden</pre>
    <form method="GET" action="/">
      <input class="button" id="reload" type="submit" value="Reload"/>
    </form>
  </div>
</body>
</html>
