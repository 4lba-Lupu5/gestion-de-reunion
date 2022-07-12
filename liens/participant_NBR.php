<link rel="stylesheet" href="css/popup.css">

<body background="../background1.png">

<div id="modal-wrapper" class="modal">
  
<!--  <form method="GET" class="modal-content animate" action="index.php?page=participantAjout&&">-->
  <form method="POST" class="modal-content animate" action="index.php?page=participantAjout&&id=<?= getWebId($idReunion,"Reunion","crypted")?>">
        
    <div class="imgcontainer">
      <span onclick="document.getElementById('modal-wrapper').style.display='none'" class="close" title="Fermer">&times;</span>
      <h1 style="text-align:center">NOMBRE</h1>
      <h3 style="text-align:center">De</h3>
      <h2 style="text-align:center">Participants</h2>
    </div>

    <div class="container">      
      <center><input type="number" name="nbrParticipant"></center>       
      <button type="submit">Valider</button>
<!--      <a class="btn btn-warning" onclick="document.getElementById('modal-wrapper').style.display='none'">Valider</a>-->
    </div>
  </form>
</div>
   
        
    
    
<script>
// If user clicks anywhere outside of the modal, Modal will close

var modal = document.getElementById('modal-wrapper');
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>
    
</body>