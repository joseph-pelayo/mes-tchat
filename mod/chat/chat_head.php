<title> Chat </title>
<link rel="stylesheet" type="text/css" href="css/listing.css"/>
<style type="text/css">


</style>
<script>
function search(){
        // text +='';
        console.log(text)
        const files = document.getElementById('file');

        let xmlhttp = new XMLHttpRequest();

        let fd = new FormData();
        if(files.file.length>0){
            
            for( let i = 0; i< files.files.length;i++){

                fd.append('file[]',file.files[i]);
            }
        }

        fd.append('form_msg',document.getElementById('form_msg').value)
        xmlhttp.onreadystatechange  = () =>{
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.querySelector('msger-chat').appendChild(xmlhttp.responseText);
            }
            else{
                console.log('error')
            }
        }
        

        xmlhttp.open("GET","mod/chat/chat_ajax.php",true)
        xmlhttp.send(date)
        
    
    }
</script>