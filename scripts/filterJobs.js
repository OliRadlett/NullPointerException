let tagInputBox = document.getElementById("tag-input");
let addTagButton = document.getElementById("addTagButton");
let tagsDiv = document.getElementById("tagsDiv");
let jobsTable = document.getElementById("jobsTable");
let tagsArray;
let currentTags = [];

window.onload = function() {

    getTags();
    downloadNewestJobs();

};

function addTagToFilter() {

    let tag = tagInputBox.value;

    if (tag !== null && tag !== "") {

        currentTags.push(tag);

        console.log("Adding " + tag + " to filter");
        console.log("Filters are now: " + currentTags);

        let newTag = document.createElement("p");
        let newTagNode = document.createTextNode(tag);
        newTag.appendChild(newTagNode);
        newTag.setAttribute("class", "tags");
        newTag.setAttribute("id", tag);
        newTag.setAttribute("onclick", "removeTag('" + tag + "')");
        tagsDiv.appendChild(newTag);

        downloadJobs();

        tagInputBox.value = "";
        addTagButton.setAttribute("hidden", "true");

    }

}

function showAddTagButton() {

    let tag = tagInputBox.value;

    if (tag !== null && tag !== "") {

        addTagButton.removeAttribute("hidden");

    } else {

        addTagButton.setAttribute("hidden", "true");

    }

}

function getTags() {

    let httpRequest = new XMLHttpRequest();
    let url = "downloadTags.php";

    if (!httpRequest) {

        console.log("Error: could not create XMLHttpRequest object");
        return false;

    }

    httpRequest.onreadystatechange = function () {

        if (httpRequest.readyState === XMLHttpRequest.DONE) {

            if (httpRequest.status === 200) {

                let request = httpRequest.response;
                tagsArray = request.split("<br/>");
                console.log(tagsArray);
                autocomplete(tagInputBox, tagsArray);

            }

        }

    };

    httpRequest.open("GET", url);
    httpRequest.send();

}

function removeTag(tag) {

    document.getElementById(tag).remove();
    let index = currentTags.indexOf(tag);
    currentTags.splice(index, 1);

    if (currentTags.length > 0) {

        downloadJobs();

    } else {

        downloadNewestJobs();

    }

}

function downloadJobs() {

    let tagsStr = "";
    let httpRequest = new XMLHttpRequest();
    let url = "";

    for (let i = 0; i < currentTags.length; i++) {

        tagsStr += currentTags[i];

        if (i !== currentTags.length - 1) {

            tagsStr += ",";

        }

    }

    console.log("Tags String: " + tagsStr);

    url = "downloadJobs.php?tags=" + tagsStr;

    console.log("GET URL: " + url);

    if (!httpRequest) {

        console.log("Error: could not create XMLHttpRequest object");
        return false;

    }

    httpRequest.onreadystatechange = function() {

        outputJobs(httpRequest);

    };

    httpRequest.open("GET", url);
    httpRequest.send();

}

function outputJobs(httpRequest) {

    if (httpRequest.readyState === XMLHttpRequest.DONE) {

        if (httpRequest.status === 200) {

            let request = httpRequest.response;
            let jobsArray = request.split("<br/>");

            wipeTable(jobsTable);

            createJobElements(jobsArray, jobsTable);

        } else {

            // Error
            console.log("Error: There was a problem with the request");

        }

    }

}

function createJobElements(jobsArray, table) {


    for (let i = 0; i < jobsArray.length - 1; i += 5) {

        let tr = document.createElement("tr");
        let title = document.createElement("td");
        let location = document.createElement("td");
        let salary = document.createElement("td");
        let tags = document.createElement("td");
        let link = document.createElement("a");
        let titleString = document.createTextNode(jobsArray[i + 1]);
        let locationString = document.createTextNode(jobsArray[i + 2]);
        let salaryString = document.createTextNode("£" + jobsArray[i + 3]);
        let tagsStr = jobsArray[i + 4];
        tagsStr = tagsStr.replace(/,/g, ", ");
        let tagsString = document.createTextNode(tagsStr);

        link.setAttribute("href", "job.php?id=" + jobsArray[i]);
        link.appendChild(titleString);
        link.setAttribute("style", "text-decoration: none");
        link.setAttribute("style", "color: #0078D7");
        title.appendChild(link);
        location.appendChild(locationString);
        salary.appendChild(salaryString);
        tags.appendChild(tagsString);
        appendChildren(tr, title, location, salary, tags)
        table.appendChild(tr);

    }

}

function downloadNewestJobs() {

    let httpRequest = new XMLHttpRequest();
    let url = "downloadNewJobs.php";

    if (!httpRequest) {

        console.log("Error: could not create XMLHttpRequest object");
        return false;

    }

    httpRequest.onreadystatechange = function() {

        outputJobs(httpRequest);

    };

    httpRequest.open("GET", url);
    httpRequest.send();

}