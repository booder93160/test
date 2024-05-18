<html>
<head></head>
<script src="/particles.min.js"></script>
<script>particlesJS.load('particles-js', '/particles.json', function() { });</script>
<body>
<div id="particles-js"></div>
<div id="main-div">
<div id="left-div">
<center>
<h1>Les maths c'est nul</h1>
<h3>Du coup on laisse la calculatrice faire</h3>
<div id="calc">
	<table>
        <tr>
          <td colspan="4" align="right" id="case" style="background: white;">
            <span id="calc-output"></span>
          </td>
        </tr>
     </table>
     <table>
       <tr>
         <td>
           <input class="number" type="button" value="1" id="button-1" onclick="btm(1)"/>
         </td>
         <td>
           <input class="number" type="button" value="2" id="button-2" onclick="btm(2)"/>
         </td>
         <td>
           <input class="number" type="button" value="3" id="button-3" onclick="btm(3)"/>
         </td>
         <td>
           <input class="operator" type="button" value="C" id="button-C" onclick="btmClean()"/>
         </td>
       </tr>

       <tr>
         <td>
           <input class="number" type="button" value="4" id="button-4" onclick="btm(4)"/>
         </td>
         <td>
           <input class="number" type="button" value="5" id="button-5" onclick="btm(5)"/>
         </td>
         <td>
           <input class="number" type="button" value="6" id="button-6" onclick="btm(6)"/>
         </td>
         <td>
           <input class="operator" type="button" value="+" id="button-+" onclick="btmPlus()"/>
         </td>
       </tr>

       <tr>
         <td>
           <input class="number" type="button" value="7" id="button-7" onclick="btm(7)"/>
         </td>
         <td>
           <input class="number" type="button" value="8" id="button-8" onclick="btm(8)"/>
         </td>
         <td>
           <input class="number" type="button" value="9" id="button-9" onclick="btm(9)"/>
         </td>
         <td>
           <input class="operator" type="button" value="-" id="button--" onclick="btmLess()"/>
         </td>
       </tr>

       <tr>
         <td>
           <input class="operator" type="button" value="x" id="button-*" onclick="btmMultiply()"/>
         </td>
         <td>
           <input class="number" type="button" value="0" id="button-0" onclick="btm(0)"/>
         </td>
         <td>
           <input class="operator" type="button" value="÷" id="button-/" onclick="btmDivision()"/>
         </td>
         <td>
           <input class="operator" type="button" value="=" id="button-=" onclick="btmEgal()"/>
         </td>
       </tr>
     </table>
</div>
</center>
</div>
<div id="right-div">
	<center>
	<?php
		if($_SESSION["CONNECTED"] == 0)
		{
			printf('<h1>Vous êtes actuellement un utilisateur anonyme</h1>');
			printf('
	<h3>Connexion</h3>
	<form action="/login/" method="POST">
		<input type="text" name="username" placeholder="username"/>
		<input type="password" name="password" placeholder="password"/>
		<input type="submit" value="Connect !"/>
	</form>

	<h3>Inscription</h3>
	<form action="/register/" method="POST">
		<input type="text" name="username" placeholder="username"/>
		<input type="password" name="password" placeholder="password"/>
		<input type="submit" value="Register !"/>
	</form>');
		}
		elseif($_SESSION["CONNECTED"] == 1)
		{
			printf('<h1>Bonjour utilisateur</h1>');
			printf('<h3>Mise à jour du mot de passe</h3>');
			printf('<form action="javascript:update_user();" method="POST">
					<input id="to_update_user" type="hidden" value="%s"/>
					<input id="to_update_password" type="password" name="password" placeholder="password"/>
					<input type="submit" value="Update !"/>
				</form>
				<form action="/disconnect/" method="POST"><input type="submit" value="Disconnect !"/></form>
			', $_SESSION["USERNAME"]);
		}
		else
		{
			printf('<h1>Bonjour administrateur</h1>');
			printf('<h3>Historique des activités utilisateur</h3>');
			printf('');

			printf('<div id="table_wrapper"><table><thead><tr><td>Ip Addr</td><td>Calcul</td><td>User Agent</td></thead><tbody>');
			$db = new SQLite3("./truc.db");

			$results = $db->query("SELECT * FROM calculs");
			while($row = $results->fetchArray())
			{
				printf('<tr><td>%s</td><td>%s</td><td>%s</td></tr>', $row["ip_addr"], $row["calcul"], $row["user_agent"]);
			}

			printf('</tbody></table></div><form action="/disconnect/" method="POST"><input type="submit" value="Disconnect !"/></form>');
		}
	?>
	</center>
</div>
</div>
<style>
body{
    background: #DDD;
    margin: 0;
    padding: 0;
}

input{
    padding: 2%;
}

#particles-js{
    position: fixed;
    width: 100%;
    height: 100%;
}

#main-div{
    height: 100%;
    width: 60%;
    position: relative;
    margin-left: 15%;
    padding: 5%;
    background: rgba(44,44,44,0.75);
}

#main-div h1, #main-div h3{
    color: #DDD;
}

#left-div{
    width: 50%;
    float: left;
}

#right-div{
    width: 50%;
    float: right;
}

#table_wrapper{
    height: 45%;
    overflow-y: scroll;
}

#right-div table{
    color: white;
    border: 1px solid black;
    border-collapse: collapse;
    margin: 25px 0;
}

#right-div td{
    border: 1px solid black;
    padding: 5px 20px;
}

#calc{
    padding: 5%;
    border-radius: 20px;
    width: 216px;
    background: #DDD;
}

.title{
    font-size: 25px;
    font-style: italic;
    font-family: sans-serif;
    color: #666;
  }
  #case{
      height: 37px;
      width: 200px;
      border: 2px solid #444;
      border-radius: 10px;
  }

  .number{
      height: 50px;
      width: 50px;
      font-size: 25px;
      color: white;
      border: 2px solid #444;
      border-radius: 10px;
      background-color: #111;
  }
  .number:hover {
    background-color: #666;
  }

  .operator{
      height: 50px;
      width: 50px;
      font-size: 25px;
      color: white;
      border: 2px solid #111;
      border-radius: 10px;
      background-color: #444;
  }
  .operator:hover{
      background-color: #666;
  }

     </style>
<script>
	var base_url = "";
	var calc_res = document.getElementById("calc-output");

	function btm(val) { calc_res.innerText += val; }
	function btmPlus() { calc_res.innerText += "+"; }
	function btmLess() { calc_res.innerText += "-"; }
	function btmMultiply() { calc_res.innerText += "*"; }
	function btmDivision() { calc_res.innerText += "/"; }
	function btmClean() { calc_res.innerText = ""; }
	function btmEgal()
	{
		var formData = new FormData();
		formData.append('calcul', calc_res.innerText);

		fetch(base_url + "/api/calcul/", { method: "POST", body: formData })
			.then(response => {
				if(!response.ok) {
					throw new Error("Fetch API failed.");
				}
				else { return response.json(); }
			})
				
			.then(data => {
				calc_res.innerText = data["result"];
			});
	}

	function update_user()
	{
		var au = document.getElementById("to_update_user").value;
		var ap = document.getElementById("to_update_password").value;

		var formData = new FormData();

		formData.append('username', au);
		formData.append('password', ap);

		fetch(base_url + "/api/user/update/", {method: "POST", body: formData});

		setTimeout(function() { location.reload(); }, 1000);
	}
</script>
