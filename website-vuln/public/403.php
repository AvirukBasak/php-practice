<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no"/>
  <title>Vuln</title>
  <style>
    * {
      font-family: monospace;
      font-size: 98%;
    }
    html, body {
      margin: 0;
    }
    div {
      padding: 25px;
      margin: 50px auto 20px;
      width: 320px;
      border: 1px solid #aaaaaa;
      border-radius: 10px;
      background-color: #dedede;
    }
    input {
      border: 1px solid #aaaaaa;
      border-radius: 10px;
      padding: 1px 7px 1px;
    }
    input.text {
      width: 220px;
      height: 25px;
      margin-bottom: 10px;
      outline: none;
    }
    input.button, button {
      width: 80px;
      height: 30px;
    }
    input.button:hover, input.button:active {
      background-color: #dedede;
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
