function undisplay(){
    var x = document.getElementsByClassName("displayButton");
    for(var i = 0; i < x.length; i++){
        x[i].style.display = "none";
    }
}

function transform(){
    document.getElementById("signinout").href = "adminlogout.php";
    document.getElementById("content-signinout").innerHTML = "Logout";
    const node = document.createElement("i");
    node.style.fontSize = "34px";
    node.classList.add("fa","fa-sign-out") 
    document.getElementById("content-signinout").appendChild(node);
}


function deleteImg(){
  document.getElementById("imgVideo").value = null;
  document.querySelector("#"+"file-preview img").src = "https://bit.ly/3ubuq5o";
  document.getElementById("deleteImg").style.display = "none";
  const node = document.createElement("p");
  const textnode = document.createTextNode("Masukkan Gambar Video Di Sini");
  node.appendChild(textnode);
  document.querySelector("#"+"file-preview div").appendChild(node);
}

function previewBeforeUpload(id){
document.querySelector("#"+id).addEventListener("change",function(e){
  if(e.target.files.length == 0){
    return;
  }
  let file = e.target.files[0];
  let url = URL.createObjectURL(file);
  document.querySelector("#"+"file-preview div").innerText = null;
  document.querySelector("#"+"file-preview img").src = url;
  document.getElementById("deleteImg").style.display = "inline-block";
});
}


function numberWithDot(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
}


function cekVideo(hasil){
    if (hasil <= 0){
      window.location.href = window.location.href;
    }else{
      window.location.href = "formDetailWorkout/delformDW.php";
    }
}