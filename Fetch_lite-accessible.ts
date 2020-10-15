//search form
const search_form = <HTMLElement>document.getElementById('search-form');
search_form.addEventListener('submit', async function (event) {
    event.preventDefault();
    (<HTMLElement>document.getElementById("errors")).removeAttribute("role");
    let results = <HTMLInputElement>document.getElementById("results");
    results.innerHTML = '';

    let search: string;
    search = (document.getElementById("search") as HTMLInputElement).value;

    fetch(`/jenntesolin.com/api/search/${search}`, {

        // Adding method type 
        method: "POST",

        // Adding body or contents to send 
        body: null,

        // Adding headers to the request 
        headers: {
            "Content-type": "application/json; charset=UTF-8"
        }
    })

        // Converting to JSON 
        .then(response => response.json())

        // Displaying results to console 
        .then(json => {

            let header = document.createElement('h2'); // is a node
            header.innerHTML = "Search Results";
            results.appendChild(header); //set div text to error message

            let allPosts = json.posts[0];
            let status = json.status;
            let type = json.type;


            if (type === "search") {
                let howmany = json.howmany;
                let countsnippet = document.createElement('p'); // is a node
                countsnippet.innerHTML = `There are <span class="search-count">${howmany}</span> pages that contain the term: <span class="search-term">${search}</span>.`;
                results.appendChild(countsnippet); //set div text to error message
            } 
            

            json.posts.forEach((element: any) => {
                let title = element.title;
                let date = new Date(element.date * 1000);
                let summary = element.summary;
                let categories = element.categories.join(', ');
                let tags = element.tags.join(', ');

                let snippet = document.createElement('p'); // is a node
                snippet.innerHTML = `<b class="search-title">${title}</b><br><span class="search-date">${date}</span><br><span class="search-categories">${categories}</span><br><span class="search-tags">${tags}</span><br><span class="search-summary">${summary}</span>`;

                results.appendChild(snippet); //set div text to error message
            });

        })

        .catch(error => {
            let errorcontainer = <HTMLElement>document.getElementById('errors'); //get div field
            errorcontainer.innerHTML = `<b>Sorry, an error occurred:</b>: ${error}`; //set div text to error message

            (<HTMLElement>document.getElementById("errors")).setAttribute("role","alert"); //add role alert for accessibility
        });

})