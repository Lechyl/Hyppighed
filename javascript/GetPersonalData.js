function sendPersonligData() {

  if ($('#inputSko').val() && $('#inputNavn').val() && $('#inputEmail').val() && $('#inputAlder').val()){

  $.ajax({
    url:'api/send/person/data',
    type:'post',
    contentType:'application/json',
    data:JSON.stringify({
      navn:$('#inputNavn').val(),
      email:$('#inputEmail').val(),
      alder:$('#inputAlder').val(),
      str:$('#inputSko').val()
    }),
    success:function (response) {
      alert("Your Personal data has been saved by us. Thank You!");
    }
  })
  }
else  {
  alert("Please fill all fields!");
  }
}