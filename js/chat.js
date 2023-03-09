var input = document.querySelector('.msger-input')
var resultat =
document.querySelector('#resultat')

input.addEventListener("keypress", function(){
  resultat.innerHTML = input.value
})