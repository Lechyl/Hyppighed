
function router(url) {
    let output;
    $.ajax({
        url: url,
        type:'GET',
        dataType: 'text',  // what to expect back from the PHP script, if anything
        headers: {
            Accept: "application/json"
        },
        success: function (response) {
           // console.log(response);
            //alert(response);
            $('#hidden-elem').html(response);
            //document.getElementById('hidden-elem').innerHTML = response;
        },
        error: function (response) {
            alert(response);
        }
    });
   // alert(output);
    return output;
}