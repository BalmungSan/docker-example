function search(){

    var in0 = document.getElementById("categorynewbook");
    var in1 = document.getElementById("author");
    var in2 = document.getElementById("name");
    var in3 = document.getElementById("prices");
    var r0 = document.getElementById("r0");
    var r1 = document.getElementById("r1");
    var r2 = document.getElementById("r2");
    var r3 = document.getElementById("r3");

    if(r0.checked){
        in1.style.display = "none";
        in2.style.display = "none";
        in3.style.display = "none";

        if(in0.style.display=="none"){
            in0.style.display="block"
        }else{
            in0.style.display="none"
        }
    }else if(r1.checked){
        in0.style.display = "none";
        in2.style.display = "none";
        in3.style.display = "none";

        if(in1.style.display=="none"){
            in1.style.display="block"
        }else{
            in1.style.display="none"
        }
    }else if(r2.checked){
        in0.style.display = "none";
        in1.style.display = "none";
        in3.style.display = "none";

        if(in2.style.display=="none"){
            in2.style.display="block"
        }else{
            in2.style.display="none"
        }
    }else{
        in0.style.display = "none";
        in1.style.display = "none";
        in2.style.display = "none";

        if(in3.style.display=="none"){
            in3.style.display="block"
        }else{
            in3.style.display="none"
        }
    }
}
