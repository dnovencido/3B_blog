var btnDelete = document.getElementById("btn-delete");

if(btnDelete) {
    btnDelete.addEventListener("click", function(e) {
        e.preventDefault();
        
        var result = confirm("Do you want to delete this blog?");
        if(result) {
            var xhttp = new XMLHttpRequest();
            xhttp.open("GET", "delete.php?blog_id=" + this.getAttribute("data-id"));

            xhttp.onreadystatechange = function() {
                if(xhttp.readyState == XMLHttpRequest.DONE) {
                    if(this.status >= 200 && this.status < 400) {
                        var res = JSON.parse(this.response);
                        
                        if(Object.keys(res).length != 0 && res.deleted == true) {
                           window.location.href = "my-blogs.php";
                        } else {
                            alert("There was an error deleting the blog. Please try again later.")
                        }
                    }
                }
            }

            xhttp.onerror = function() {
                alert("There was an error in accessing the specified resource.");
            }

            xhttp.send();
        }
    });
}