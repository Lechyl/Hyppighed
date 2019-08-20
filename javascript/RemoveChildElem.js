function removeAllChildElem() {

   let child = $('#hidden-elem');
   while (child.firstChild){
       child.removeChild(child);
   }
}