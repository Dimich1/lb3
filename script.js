window.onload = () => {
    const author = document.getElementById("author");

    author.addEventListener("submit", function (event) {
        event.preventDefault();

        const thisAuthor = new FormData(this);
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "db.php");
        xhr.responseType = 'document';
        xhr.send(thisAuthor);

        xhr.onload = () => {
            document.getElementById("content").innerHTML = xhr.responseXML.body.innerHTML;
        }
    })

    const publisher = document.getElementById("publisher");

    publisher.addEventListener("submit", function (event) {
        event.preventDefault();

        const thisPublisher = new FormData(this);
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "db.php");
        xhr.responseType = 'text';
        xhr.send(thisPublisher);

        xhr.onload = () => {
            document.getElementById("content").innerHTML = xhr.responseText;
        }
    })

    const time = document.getElementById("time");

    time.addEventListener("submit", function (event) {
        event.preventDefault();

        const thisTime = new FormData(this);
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "db.php");
        xhr.responseType = 'json';
        xhr.send(thisTime);

        xhr.onload = () => {
            document.getElementById("content").innerHTML = xhr.response;
        }
    })
}


