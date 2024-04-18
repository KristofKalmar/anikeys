$(document).ready(function(){
    $("#profilePic").click(function(){
        $("#fileToUpload").click();
    });

    $("#fileToUpload").change(function(){
        readURL(this);
    });
});

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        
        reader.onload = function(e) {
            $('#profilePic').attr('src', e.target.result);
        }
        
        reader.readAsDataURL(input.files[0]);
    }
}