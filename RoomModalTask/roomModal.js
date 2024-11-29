const modal = document.getElementById("myModal");

const btn = document.getElementById("openModal");

const closebtn = document.getElementById("closeModal");

btn.onclick = function(){
    modal.style.display = "block";
}

closebtn.onclick = function(){
    modal.style.display = "none";
}

window.onclick = function(event) {
    if (event.target == modal) {
      modal.style.display = "none";
    }
  }