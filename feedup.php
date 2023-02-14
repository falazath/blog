<!DOCTYPE html>
<html>
<style>

#myBtn {
  display: none;
  position: fixed;
  bottom: 20px;
  right: 30px;
  z-index: 99;
  font-size: 18px;
  border: none;
  outline: none;
  background-color: white;
  cursor: pointer;
  padding: 15px;
  border-radius: 70px;
}

#myBtn:hover {
  box-shadow: 2px 2px 15px rgba(0, 0, 0, 0.400);
}

</style>
</head>
<body>

    <div class="Line">
      <a href="https://lin.ee/6S2ek6H"><img src="img/Line.png" alt="AddLine"></a>
    </div>

<button onclick="topFunction()" id="myBtn" title="Go to top">
  <img src="img/feedup.png" alt="image" weight="25px" height="25px">
</button>

<script>
// Get the button
let mybutton = document.getElementById("myBtn");

// When the user scrolls down 20px from the top of the document, show the button
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
    mybutton.style.display = "block";
  } else {
    mybutton.style.display = "none";
  }
}

// When the user clicks on the button, scroll to the top of the document
function topFunction() {
  document.body.scrollTop = 0;
  document.documentElement.scrollTop = 0;
}
</script>

</body>
</html>
