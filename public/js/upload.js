// Functia care adauga o noua casuta de upload in formular
function add_upload(form_id){
	//alert(form_id);
  // Elementul inaintea caruia e adaugat cel nou
  var element = document.getElementById('sub');

  // Creaza elementul nou <input>, si atributele lui
  var new_el = document.createElement('input');
  new_el.setAttribute('type', 'file');
  new_el.setAttribute('name', 'file_up[]');
  document.getElementById(form_id).insertBefore(new_el, element);
}

// Functia care trimite datele din formular, fiind transferate la iframe
function uploading(theform){
  // Adauga codul cu iframe-ul
  document.getElementById('ifrm').innerHTML = '<iframe id="uploadframe" name="uploadframe" src="uploader.php" frameborder="0"></iframe>';

  theform.submit();    // Executa trimiterea datelor

  // Reinoeste formularul
  document.getElementById('uploadform').innerHTML = '<input type="file" id="test" class="file_up" name="file_up[]" /><input type="submit" value="UPLOAD" id="sub" />';
  return false;
}