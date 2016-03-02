function recupDate(id)
{
    var formulaire = document.getElementById("choixFiche");
    var selectObjet = document.getElementById("lstDates");
    if(window.FormData)
    {
        var fd = new FormData();
    }
    else
    {
        alert("FormData non supporté");
        return;
    }
    var count = selectObjet.options.length;
    if (count != 0)
    {
        for(i=count-1;i>=0;i--)
        {
            selectObjet.remove(i);
        }
    }
    fd.append("id", id);
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "include/ajx.fillDate.php", true);
    xhr.onreadystatechange = function(event)
    {
        if(this.readyState === 4)
        {
            selectObjet.innerHTML += xhr.responseText;
        }
    }
    
    xhr.send(fd);
    
}