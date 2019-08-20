$(document).ready(function () {
  // getInputForm();
  router('api/router/input_form');

   $('#link-home').on('click',function () {
      router('api/router/input_form');

   });
   $('#link-personligData').on('click',function () {
      router('api/router/person_data');

   });
   $('#link-graf').on('click',function () {
      diagram();
   });

   $('#hidden-elem').delegate("#inputSubmit","click",function () {
      sendPersonligData();
   });

});