var xmlHttp;

function like(str)
{ 
    xmlHttp=GetXmlHttpObject();
    if (xmlHttp==null)
    {
        alert ("Browser does not support HTTP Request");
        return;
    }
    var url="php/like.php";
    url=url+"?id="+str;
    var action=document.getElementById("like-button").value;
    url=url+"&action="+action;
    xmlHttp.onreadystatechange=stateChanged;
    xmlHttp.open("GET",url,true);
    xmlHttp.send(null);

}

function stateChanged() 
{ 
    

    if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
    { 
        if((document.getElementById("like-button").value)=="like"){
            document.getElementById("like-button").value="nolike";
            document.getElementById("like-button").innerHTML="nolike";
        }
        else{
            document.getElementById("like-button").value="like";
            document.getElementById("like-button").innerHTML="like";
        }

        document.getElementById("count-like").innerHTML=xmlHttp.responseText;
    } 
}

function GetXmlHttpObject()
{
    var xmlHttp=null;
    try
    {
        // Firefox, Opera 8.0+, Safari
        xmlHttp=new XMLHttpRequest();
    }
    catch (e)
    {
        //Internet Explorer
        try
        {
            xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
        }
        catch (e)
        {
            xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
        }
    }
    return xmlHttp;
}