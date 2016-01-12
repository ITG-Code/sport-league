function addHomeGoals() {
  var xhttp;
  var v = document.getElementById("match_home_goals_nr").value;
  var match = document.getElementById("match_id").value;
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (xhttp.readyState == 4 && xhttp.status == 200) {
    document.getElementById("match_home_goals").innerHTML = xhttp.responseText;
    //document.getElementById("match_home_goals").innerHTML = match;
    }
  };
  xhttp.open("GET", "ajax/match_players.php?match="+match+"&home=1&amount="+v, true);
  xhttp.send();
}

function addGoneGoals() {
  var xhttp;
  var v = document.getElementById("match_gone_goals_nr").value;
  var match = document.getElementById("match_id").value;
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (xhttp.readyState == 4 && xhttp.status == 200) {
    document.getElementById("match_gone_goals").innerHTML = xhttp.responseText;
    }
  };
  xhttp.open("GET", "ajax/match_players.php?match="+match+"&home=0&amount="+v, true);
  xhttp.send();
}
